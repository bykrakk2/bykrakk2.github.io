<?php
class QIWI_LazyPay {
    public $iQiwiAccount, $aBalances = array( 'USD' => 0, 'RUB' => 0, 'EUR' => 0, 'KZT' => 0 );
    private $sCookieFile, $sProxy;
   
    # ����������� - �������������� ������ ������.
    # ���������: qiwi.������� (� ������������� ������� ��� +), ������, ������ (�� �����������).
     public function __construct( $iQiwiAccount, $sPassword, $sCookieFile, $sProxy = null ) {
        
 
 
        # ������������� ������ ������ :
        $this->sCookieFile = $sCookieFile;
        $this->sProxy = $sProxy;

        # ������ � ������� :
        $this->curl( 'person/state.action' );
        
        # �������� ����������� ��������� :
        if( isset( $this->aResponse['data'] ) && isset( $this->aResponse['data']['person'] ) && isset( $this->aResponse['data']['balances'] ) && $this->aResponse['data']['person'] == $iQiwiAccount ) {
            
            # ������������� ���������� ������ :
            $this->iQiwiAccount = $this->aResponse['data']['person'];
            
            # ���������� ���������� � �������� :
            foreach( $this->aResponse['data']['balances'] as $sEquivalent => $dBalance ) {
                
                # ��������� ������ � ������ :
                $this->aBalances[$sEquivalent] = $dBalance;
            }
            return;
        }
        
        # ������ � ������� :
        $this->curl( 'https://auth.qiwi.com/cas/tgts', json_encode( array( 'login' => '+'.$iQiwiAccount, 'password' => $sPassword ) ) );
        
        # ���� � ������ ���� ������ :
        if( isset( $this->aResponse['entity'] ) && isset( $this->aResponse['entity']['error'] ) && isset( $this->aResponse['entity']['error']['message'] ) )
            throw new Exception( strtolower( $this->aResponse['entity']['error']['message'] ) );
        
        # ���� � ������ ��� ������ :
        if( !isset( $this->aResponse['entity'] ) || !isset( $this->aResponse['entity']['ticket'] ) )
            throw new Exception( 'ticket �� ������ - '.$this->sResponse );
        
        # ��� � ��� TGT �����
        $sTGTToken = $this->aResponse['entity']['ticket'];
        
        # ������ � ������� :
        $this->curl( 'https://auth.qiwi.com/cas/sts', json_encode( array( 'service' => 'https://qiwi.com/j_spring_cas_security_check', 'ticket' => $sTGTToken ) ) );
        
        # ���� � ������ ���� ������ :
        if( isset( $this->aResponse['entity'] ) && isset( $this->aResponse['entity']['error'] ) && isset( $this->aResponse['entity']['error']['message'] ) )
            throw new Exception( mb_strtolower( $this->aResponse['entity']['error']['message'] ) );
        
        # ���� � ������ ��� ������ :
        if( !isset( $this->aResponse['entity'] ) || !isset( $this->aResponse['entity']['ticket'] ) )
            throw new Exception( 'ticket �� ������ - '.$this->sResponse );
        
        # ������ � ������� :
        $this->curl( 'https://qiwi.com/j_spring_cas_security_check?ticket='.$this->aResponse['entity']['ticket'] );
        
        # ���� � ������ ���� ������ :
        if( isset( $this->aResponse['message'] ) && $this->aResponse['message'] != '' )
            throw new Exception( $this->aResponse['message'] );
        
        # ���� ����������� �� �������� :
        if( !isset( $this->aResponse['code'] ) || !isset( $this->aResponse['code']['_name'] ) || $this->aResponse['code']['_name'] != 'NORMAL' )
            throw new Exception( 'error authorize - '.$this->sResponse );
        
        # ��������� ���������� �� qiwi.�������� :
        $this->curl( 'person/state.action' );

        # ���� �������� ������:
        if( !isset( $this->aResponse['data'] ) || !is_array( $this->aResponse['data'] ) || !isset( $this->aResponse['data']['person'] ) || !isset( $this->aResponse['data']['balances'] ) )
            throw new Exception( var_export( $this->aResponse, true ) );
        
        # ������������� ���������� ������ :
        $this->iQiwiAccount = $this->aResponse['data']['person'];
        
        # ���������� ���������� � �������� :
        foreach( $this->aResponse['data']['balances'] as $sEquivalent => $dBalance ) {
            
            # ������������� ���������� ������ :
            $this->aBalances[$sEquivalent] = $dBalance;
        }
    }
    
    # ����� : ������� �������.
    # ��������� : ���� �������, �����, ������, ����������.
    # ���������� : � ����������.
    public function SendMoney( $iQiwiAccount, $dAmount, $sCurrency, $sComment ) {
        return $this->payment( null, array( 'account' => '+'.$iQiwiAccount, 'comment' => $sComment ), $dAmount, $sCurrency, $sCurrency );
    }
   
    public function SvyaznoyBankTransfer( $iCard, $iOperType, $dAmount, $sComment ) {
        return $this->payment( 23022, array( 'account' => $iCard, 'account_type' => 1, 'comment' => $sComment, 'mfo' => '044583139', 'oper_type' => $iOperType, 'pay_type' => 3005, 'pfp' => 1388597437 ), $dAmount );
    }
    public function TCSBankTransfer( $iAccountType, $iCard, $iOperType, $dAmount, $sComment ) {
        return $this->payment( 466, array( 'account' => $iCard, 'account_type' => $iAccountType, 'comment' => $sComment, 'mfo' => '', 'oper_type' => $iOperType, 'pay_type' => 3005, 'pfp' => 1388597437 ), $dAmount );
    }
    public function AlfaBankTransfer( $iAccountType, $iAccount, $iOperType, $dAmount, $sComment, $sExpDate = '' ) {
        return $this->payment( 464, array( 'account' => $iAccount, 'account_type' => $iAccountType, 'comment' => $sComment, 'exp_date' => $sExpDate, 'mfo' => '044525593', 'oper_type' => $iOperType, 'pay_type' => 3005, 'pfp' => 1388597437 ), $dAmount );
    }
    public function RussianStandartBankTransfer( $iAccountType, $iCard, $iOperType, $dAmount, $sComment ) {
        return $this->payment( 815, array( 'account' => $iCard, 'account_type' => $iAccountType, 'comment' => $sComment, 'mfo' => '044583151', 'oper_type' => $iOperType, 'pay_type' => 3005, 'pfp' => 1388597437 ), $dAmount );
    }
    public function MoskoPrivatBankTransfer( $iCard, $iOperType, $dAmount, $sComment ) {
        return $this->payment( 830, array( 'card_num' => $iCard, 'account_type' => '1', 'comment' => $sComment, 'mfo' => '044585342', 'oper_type' => $iOperType, 'pay_type' => 3005, 'pfp' => 1388597437 ), $dAmount );
    }
    public function BankCardTransfer( $iCard, $dAmount, $sComment ) {
        
        # � ����������� �� ���������� :
        switch( $this->getCardProvider( $iCard ) ) {
            
            # MasterCard MoneySend (������������� �������) :
            case 21013:
                return $this->payment( 21013, array( 'account' => $iCard, 'exp_date' => '', 'comment' => $sComment ), $dAmount );
        
            # MasterCard MoneySend (������������� �������) :
            case 21012:
                return $this->payment( 21012, array( 'rem_name_f' => '������', 'rem_name' => '�������', 'rec_country' => '������', 'rec_city' => '������', 'rec_address' => '��. ����������, 19', 'account' => $iCard, 'exp_date' => '', 'comment' => $sComment ), $dAmount );
        
            # Visa Personal Payments (������) :
            case 1963:
                return $this->payment( 1963, array( 'account' => $iCard, 'comment' => $sComment ), $dAmount );
                
            # Visa Personal Payments (������������� �������) :
            case 1960:
                return $this->payment( 1960, array( 'rem_name_f' => '������', 'rem_name' => '�������', 'rec_country' => '������', 'rec_city' => '������', 'rec_address' => '��. ����������, 19', 'account' => $iCard, 'comment' => $sComment ), $dAmount );
        }
        
        throw new Exception( 'provider not programming' );
    }
    
    public function VisaTransfer( $iCard, $dAmount, $sComment ) {
        return $this->payment( 21013, array( 'account' => substr( $iCard, 0, 4 ).'-'.substr( $iCard, 4, 4 ).'-'.substr( $iCard, 8, 4 ).'-'.substr( $iCard, -4 ), 'comment' => $sComment, 'rec_address' => '', 'rec_city' => '', 'rec_country' => '', 'rem_name' => '', 'rem_name_f' => '' ), $dAmount );
    }
    public function MasterCardRUTransfer( $iCard, $sExpDate, $dAmount, $sComment ) {
        return $this->payment( 21013, array( 'account' => $iCard, 'comment' => $sComment, 'exp_date' => $sExpDate, 'rec_address' => '', 'rec_city' => '', 'rec_country' => '', 'rem_name' => '', 'rem_name_f' => '' ), $dAmount );
    }
    public function MasterCardINTTransfer( $iCard, $sSenderLastName, $sSenderFirstName, $sReceiverCountry, $sReceiverCity, $sReceiverAddress, $sExpDate, $dAmount, $sComment ) {
        return $this->payment( 21012, array( 'account' => $iCard, 'comment' => $sComment, 'exp_date' => $sExpDate, 'rec_address' => $sReceiverAddress, 'rec_city' => $sReceiverCity, 'rec_country' => $sReceiverCountry, 'rem_name' => $sSenderFirstName, 'rem_name_f' => $sSenderLastName ), $dAmount );
    }
    public function WebMoneyTransfer( $sWMRPurse, $dAmount, $sComment ) {
        return $this->payment( 56, array( 'account' => $sWMRPurse, 'comment' => $sComment ), $dAmount );
    }
    public function PrivatMoneyTransfer( $sFromFirstName, $sFromLastName, $sFromMiddleName, $sToFirstName, $sToLastName, $sToMiddleName, $iToCountry, $iToPhone, $dAmount, $sComment ) {
        return $this->payment( 20243, array( 'account' => '+'.$iToPhone, 'comment' => $sComment, 'control_code' => '', 'country' => $iToCountry, 'from_name' => $sFromFirstName, 'from_name_f' => $sFromLastName, 'from_name_p' => $sFromMiddleName, 'rec_amount' => $dAmount, 'rec_course' => 1, 'rec_currency' => 810, 'to_name' => $sToFirstName, 'to_name_f' => $sToLastName, 'to_name_p' => $sToMiddleName ), $dAmount );
    }
    public function AnelikTransfer( $iRemitent, $iPin, $dAmount, $sComment ) {
        return $this->payment( 1895, array( 'remitent' => $iRemitent, 'pin' => $iPin, 'comment' => $sComment ), $dAmount );
    }
    public function VTB24Transfer( $iAccount, $iUrgent, $sBirthday, $sBirthplace, $sFirstName, $sLastName, $sMiddleName, $iMFO, $iOperType, $dAmount, $sComment ) {
        return $this->paymentBank( 816, array( 'account' => $iAccount, 'account_type' => '2', 'bdate' => $sBirthday, 'bplace' => $sBirthplace, 'comment' => $sComment, 'fname' => $sFirstName, 'lname' => $sLastName, 'mfo' => $iMFO, 'mname' => $sMiddleName, 'oper_type' => $iOperType, 'pay_type' => '3005', 'pfp' => '1396686537', 'urgent' => $iUrgent ), $dAmount );
    }
    public function SberBankTransfer( $iAccount, $iUrgent, $sBirthday, $sBirthplace, $sFirstName, $sLastName, $sMiddleName, $iMFO, $iOperType, $dAmount, $sComment ) {
        return $this->paymentBank( 870, array( 'account' => $iAccount, 'account_type' => '2', 'bdate' => $sBirthday, 'bplace' => $sBirthplace, 'comment' => $sComment, 'fname' => $sFirstName, 'lname' => $sLastName, 'mfo' => $iMFO, 'mname' => $sMiddleName, 'oper_type' => $iOperType, 'pay_type' => '3005', 'pfp' => '1388597437', 'urgent' => $iUrgent ), $dAmount );
    }
    public function RaiffeisenbankTransfer( $iAccount, $iUrgent, $sBirthday, $sBirthplace, $sFirstName, $sLastName, $sMiddleName, $iMFO, $iOperType, $dAmount, $sComment ) {
        return $this->paymentBank( 872, array( 'account' => $iAccount, 'account_type' => '2', 'bdate' => $sBirthday, 'bplace' => $sBirthplace, 'comment' => $sComment, 'fname' => $sFirstName, 'lname' => $sLastName, 'mfo' => $iMFO, 'mname' => $sMiddleName, 'oper_type' => $iOperType, 'pay_type' => '3005', 'pfp' => '1396685698', 'urgent' => $iUrgent ), $dAmount );
    }
    public function EuropeBankTransfer( $iAccount, $iAccountType, $sBirthday, $sBirthplace, $sFirstName, $sLastName, $sMiddleName, $iOperType, $dAmount, $sComment ) {
        return $this->payment( 931, array( 'account' => $iAccount, 'account_type' => $iAccountType, 'bdate' => $sBirthday, 'bplace' => $sBirthplace, 'comment' => $sComment, 'exp_date' => '', 'fname' => $sFirstName, 'lname' => $sLastName, 'mfo' => '044525767', 'mname' => $sMiddleName, 'oper_type' => $iOperType, 'pfp' => '1388597437' ), $dAmount );
    }
    public function SkypeTransfer( $sAccount, $dAmount, $sComment = '' ) {
        return $this->payment( 23195, array( 'account' => $sAccount, 'comment' => $sComment ), $dAmount, 'USD' );
    }
    public function OdnoklassnikiTransfer( $sAccount, $dAmount, $sComment = '' ) {
        return $this->payment( 1746, array( 'account' => $sAccount, 'comment' => $sComment ), $dAmount );
    }
    public function SvyaznoyBank( $iEAN, $dAmount, $sComment = '', $iOperType = 3 ) {
        return $this->payment( 23022, array( 'account' => $iEAN, 'oper_type' => $iOperType, 'comment' => $sComment ), $dAmount );
    }
    public function InvoicePayment( $iPhone, $dAmount, $sCurrency, $sComment ) {
        
        # ������������� ����� ������� :
        $dAmount = intval( str_replace( ',', '.', $dAmount ) * 100 ) / 100;
        $aAmount = explode( '.', $dAmount );
        if( !isset( $aAmount[1] ) )
            $aAmount[1] = '00';
        else if( strlen( $aAmount[1] ) != 2 )
            $aAmount[1] .= '0';

        # �������� ������� �� ������� ����� :
        $sResponse = $this->curl( 'user/order/create.action?to=%2B'.$iPhone.'&value='.$aAmount[0].'&change='.$aAmount[1].'&amount='.$dAmount.'&currency='.$sCurrency.'&comment='.urlencode( $sComment ) );

        # ���� ������ ������ ������ :
        if( mb_strpos( $sResponse, 'ERROR' ) !== false ) {
            $aExplode = explode( '"message":"', $sResponse );
            $aExplode = explode( '"', $aExplode[1] );
            throw new Exception( $aExplode[0], 1 );
        }
        else if( mb_strpos( $sResponse, '{"value":"0","_name":"NORMAL"}' ) === false ) {
            $aExplode = explode( '<p class="errorMarker">', $sResponse );
            $aExplode = explode( '</p>', $aExplode[1] );
            throw new Exception( $aExplode[0], 1 );
        }
        
        $aHistory = $this->GetInvoices( date( 'd.m.Y', strtotime( '-1 day' ) ), date( 'd.m.Y', strtotime( '+1 day' ) ) );
        $aInvoice = array_shift( $aHistory );
        if( $aInvoice === false || $aInvoice['dAmount'] != $dAmount || $aInvoice['iOpponentPhone'] != $iPhone || $aInvoice['sStatus'] != 'NOT_PAID' )
            throw new Exception( 'invoice not found in history: '.var_export( $aInvoice, true ) );
        return array( 'iInvoiceID' => $aInvoice['iID'], 'iOrderID' => $aInvoice['iOrderID'] );
    }
    public function GetHistory( $sStartDate, $sFinishDate ) {
        
        # ��������� ������ ���������� :
        $sResult = $this->curl( 'user/report/list.action?daterange=true&start='.$sStartDate.'&finish='.$sFinishDate );
 
        $aTransactions = array();
        foreach( explode( '</div><div class="reportsLine ', str_replace( '> <', '><', preg_replace( '!\s+!u', ' ', $sResult ) ) ) as $iKey => $sValue ) {
            if( $iKey == 0 )
                continue;
            
            $aData = array();

            # ��������� ����� ����� :
            $aData['iID'] = explode( '<span class="value">', $sValue );
            if( count( $aData['iID'] ) < 2 )
                continue;
            $aData['iID'] = explode( '</', $aData['iID'][1] );
            $aData['iID'] = trim( $aData['iID'][0] );
            
            # ��������� ���� � ����� :
            $aData['sDate'] = explode( 'class="date">', $sValue );
            $aData['sDate'] = explode( '</', $aData['sDate'][1] );
            $aData['sDate'] = trim( $aData['sDate'][0] );
            $aData['sTime'] = explode( 'class="time">', $sValue );
            $aData['sTime'] = explode( '</', $aData['sTime'][1] );
            $aData['sTime'] = trim( $aData['sTime'][0] );
            
            # ��������� ����� :
            $aData['sAmount'] = explode( 'class="originalExpense"><span>', $sValue );
            $aData['sAmount'] = explode( '</', $aData['sAmount'][1] );
            $aData['sAmount'] = trim( $aData['sAmount'][0] );
            $aData['dAmount'] = preg_replace( '/[^0-9\.]+/', '', str_replace( ',', '.', $aData['sAmount'] ) ) - 0;
            
            # ��������� ������ ����� :
            $aData['sCurrency'] = mb_strpos( $aData['sAmount'], '���.' ) !== false ? 'RUB' : (mb_strpos( $aData['sAmount'], '����.' ) !== false ? 'USD' : (mb_strpos( $aData['sAmount'], '�����.' ) !== false ? 'KZT' : 'NAN'));
            
            # ��������� ����� � ������ �������� :
            $aData['sWithExpend'] = explode( 'WithExpend', $sValue );
            $aData['sWithExpend'] = explode( '</div>', $aData['sWithExpend'][1] );
            $aData['sWithExpend'] = explode( '<div class="cash">', $aData['sWithExpend'][0] );
            $aData['sWithExpend'] = trim( $aData['sWithExpend'][1] );
            $aData['dWithExpend'] = preg_replace( '/[^0-9\.]+/', '', str_replace( ',', '.', $aData['sWithExpend'] ) ) - 0;
            
            # ��������� ������ �������� �������������� :
            $aData['iOpponentPhone'] = explode( 'class="opNumber">', $sValue );
            $aData['iOpponentPhone'] = explode( '</', $aData['iOpponentPhone'][1] );
            $aData['iOpponentPhone'] = trim( str_replace( '+', '', $aData['iOpponentPhone'][0] ) );
            
            # ��������� ���������� :
            $aData['sComment'] = explode( 'class="comment">', $sValue );
            $aData['sComment'] = explode( '</', $aData['sComment'][1] );
            $aData['sComment'] = html_entity_decode( trim( $aData['sComment'][0] ), ENT_QUOTES, 'UTF-8' );
            
            # �������� ���������� � ���������� :
            $aData['sProvider'] = explode( '<div class="provider"><span>', $sValue );
            $aData['sProvider'] = explode( '</span>', $aData['sProvider'][1] );
            $aData['sProvider'] = trim( $aData['sProvider'][0] );
            
            # ������� ��� ������ ?
            $aData['sType'] = mb_strpos( $sValue, 'IncomeWithExpend expenditure' ) !== false ? 'EXPENDITURE' : (mb_strpos( $sValue, 'IncomeWithExpend income' ) !== false ? 'INCOME' : 'NAN');
            
            # ��������� ������� ���������� :
            $aData['sStatus'] = explode( '"', $sValue );
            $aData['sStatus'] = str_replace( 'status_', '', trim( $aData['sStatus'][0] ) );
            
            # ��������  ���������� � ������ ���� ��� ���� :
            if( $aData['sStatus'] == 'ERROR' ) {
                $aData['sError'] = explode( '{"message":"', $sValue );
                $aData['sError'] = explode( '"', $aData['sError'][1] );
                $aData['sError'] = trim( $aData['sError'][0] );
            }
            
            # �������������� �������� :
            if( $aData['iID'] == false ) {
                $aData['iID'] = explode( '{"txn":', $sValue );
                $aData['iID'] = explode( '}', $aData['iID'][1] );
                $aData['iID'] = $aData['iID'][0];
            }
            
            $aTransactions['ID-'.$aData['iID']] = $aData;
        }
        return $aTransactions;
    }
    public function GetInvoices( $sStartDate, $sFinishDate ) {
        
        # ��������� ������ ���������� ������ :
        $sResult = $this->curl( 'user/order/list.action?daterange=true&start='.$sStartDate.'&finish='.$sFinishDate.'&conditions.directions=out' );

        $aTransactions = array();
        foreach( explode( '<div class="ordersLine ', str_replace( '> <', '><', preg_replace( '!\s+!u', ' ', $sResult ) ) ) as $iKey => $sValue ) {
            if( $iKey == 0 )
                continue;
            
            $aData = array();
            
            # ��������� ����� ����� :
            $aData['iID'] = explode( 'class="transaction"><span>', $sValue );
            $aData['iID'] = explode( '</', $aData['iID'][1] );
            $aData['iID'] = trim( $aData['iID'][0] );
            
            # ��������� ���� ������� ����� :
            $aData['sCreateDate'] = explode( 'class="orderCreationDate">', $sValue );
            $aData['sCreateDate'] = explode( '</', $aData['sCreateDate'][1] );
            $aData['sCreateDate'] = trim( $aData['sCreateDate'][0] );
            
            # ��������� ����� � ������ ����� :
            $aData['sAmount'] = explode( 'class="amount">', $sValue );
            $aData['sAmount'] = explode( '</', $aData['sAmount'][1] );
            $aData['sAmount'] = trim( $aData['sAmount'][0] );
            
            # ��������� ����� ����� :
            $aData['dAmount'] = preg_replace( '/[^0-9\.]+/', '', str_replace( ',', '.', $aData['sAmount'] ) ) - 0;
            
            # ��������� ������ ����� :
            $aData['sCurrency'] = mb_strpos( $aData['sAmount'], '����.' ) !== false ? 'EUR' : (mb_strpos( $aData['sAmount'], '���.' ) !== false ? 'RUB' : (mb_strpos( $aData['sAmount'], '����.' ) !== false ? 'USD' : (mb_strpos( $aData['sAmount'], '�����.' ) !== false ? 'KZT' : 'NAN')));
            
            # ��������� ������ �������� �������������� :
            $aData['iOpponentPhone'] = explode( 'class="from"><span>', $sValue );
            $aData['iOpponentPhone'] = explode( '</', $aData['iOpponentPhone'][1] );
            $aData['iOpponentPhone'] = trim( $aData['iOpponentPhone'][0] );
            
            # ��������� ���������� :
            $aData['sComment'] = explode( 'class="commentItem">', $sValue );
            $aData['sComment'] = explode( '</', $aData['sComment'][1] );
            $aData['sComment'] = trim( $aData['sComment'][0] );
            
            # ��������� ���� ������ ����� :
            $aData['sPayDate'] = explode( 'class="payDate">', $sValue );
            $aData['sPayDate'] = explode( '</', $aData['sPayDate'][1] );
            $aData['sPayDate'] = trim( $aData['sPayDate'][0] );
            
            # ��������� ������� ���������� :
            $aData['sStatus'] = explode( '"', $sValue );
            $aData['sStatus'] = str_replace( 'status_', '', trim( $aData['sStatus'][0] ) );
            
            if( $aData['sStatus'] == 'NOT_PAID' ) {
                $aData['iOrderID'] = explode( '{"data":{"order":"', $sValue );
                $aData['iOrderID'] = explode( '"', $aData['iOrderID'][1] );
                $aData['iOrderID'] = $aData['iOrderID'][0];
            }
            
            $aTransactions['ID-'.$aData['iID']] = $aData;
        }
        return $aTransactions;
    }
    public function GetBalances() {
        if( ($aResponse = @json_decode( $this->curl( 'person/state.action' ), true )) === false )
            throw new Exception( 'internal error' );
        else if( !is_array( $aResponse['data'] ) || !isset( $aResponse['data']['person'] ) || !isset( $aResponse['data']['balances'] ) )
            throw new Exception( var_export( $aResponse['data'], true ) );
        $this->iQiwiAccount = $aResponse['data']['person'];
        foreach( $aResponse['data']['balances'] as $sEquivalent => $dBalance )
            $this->aBalances[$sEquivalent] = $dBalance;
        return $this->aBalances;
    }
    public function CancelInvoice( $iOrderID ) {
        if( ($aResponse = @json_decode( $this->curl( 'user/order/reject.action', 'order='.$iOrderID ), true )) === false || !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( 'internal error' );
        if( ($aResponse = @json_decode( $this->curl( 'user/order/reject.action', 'order='.$iOrderID.'&token='.$aResponse['data']['token'] ), true )) === false )
            throw new Exception( 'internal error' );
        return isset( $aResponse['code'] ) && isset( $aResponse['code']['value'] ) && $aResponse['code']['value'] == 0;
    }
    public function payment( $iProvider, array $aExtra, $dAmount, $sCurrency = 'RUB', $sPayCurrency = 'RUB' ) {
        
        # ������������� ����� ������� :
        $dAmount = intval( str_replace( ',', '.', $dAmount ) * 100 ) / 100;
        $aAmount = explode( '.', $dAmount );
        if( !isset( $aAmount[1] ) )
            $aAmount[1] = '00';
        else if( strlen( $aAmount[1] ) != 2 )
            $aAmount[1] .= '0';
        
        # ������������� ������ aExtra :
        foreach( $aExtra as $sKey => $sValue ) {
            $aExtra["extra['".$sKey."']"] = $sValue;
            unset( $aExtra[$sKey] );
        }
        
        # ������ �� ��������� ����� ������� :
        $this->curl( is_null( $iProvider ) ? 'payment/transfer/form.action' : 'payment/form.action?provider='.$iProvider );
        
        # ������ �� ��������� ������ ������� :
        if( ($aResponse = @json_decode( $this->curl( 
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => $aAmount[0],
                    'amountFraction' => $aAmount[1],
                    'arg_num' => '',
                    'currency' => $sCurrency,
                    'protected' => 'true',
                    'source' => 'qiwi_'.$sPayCurrency,
                    'state' => 'CONFIRM' 
                ), $aExtra )
            )
        ), true )) === false )
            throw new Exception( 'internal error, step 1' );
        
        # �������� ������� ������� :
        if( !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : 'internal error, step 2' );
            
        # ���������� ������� � ������� :
        $sResponse = $this->curl(
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => $aAmount[0],
                    'amountFraction' => $aAmount[1],
                    'arg_num' => '',
                    'currency' => $sCurrency,
                    'protected' => 'true',
                    'source' => 'qiwi_'.$sPayCurrency,
                    'state' => 'CONFIRM',
                    'token' => $aResponse['data']['token'],
                ), $aExtra )
            )
        );

        # ������ �� ��������� ������ ������������� ������� :
        if( ($aResponse = @json_decode( $this->curl( 'payment/form/state.action?state=PAY' ), true )) === false )
            throw new Exception( 'internal error, step 3' );
        
        # �������� ������� ������� :
        if( !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : 'internal error, step 4' );

        # ������������ ���������� ������� :
        $sResponse = $this->curl(
            'payment/form/state.action',
            array(
                'token' => $aResponse['data']['token'],
                'state' => 'PAY'
            )
        );

        # ���� ������ ��� �� ������� :
        if( mb_strpos( $sResponse, 'transaction":"' ) === false ) {
            if( mb_strpos( $sResponse, 'class="errorElement"' ) !== false ) {
                $aExplode = explode( 'class="errorElement">', $sResponse );
                $aExplode = explode( '</', $aExplode[1] );
                throw new Exception( trim( $aExplode[0] ) );
            }
            # �����, ���� ��������� SMS ������������� �������� :
            else if( mb_strpos( $sResponse, 'confirmPage' ) !== false )
                return false;
            else {
                if( count( $sMessage = explode( '<p>', $sResponse ) ) < 2 )
                    throw new Exception( 'unknown error' );
                $sMessage = explode( '</p>', $sMessage[1] );
                throw new Exception( $sMessage[0] );
            }
        }
        
        # ���� ��������� - Qiwi ���� :
        if( $iProvider == 22496 ) {
            if( count( $aExplode = explode( '��� �������:', $sResponse ) ) < 2 )
                throw new Exception( 'error parse egg' );
            $aExplode = explode( '</', $aExplode[1] );
            return trim( $aExplode[0] );
        }
            
        # ��������� ������� ��������� :
        $aHistory = $this->GetHistory( date( 'd.m.Y', strtotime( '-1 day' ) ), date( 'd.m.Y', strtotime( '+1 day' ) ) );
        $aTransfer = array_shift( $aHistory );
        if( $aTransfer === false || $aTransfer['dAmount'] != $dAmount || $aTransfer['sCurrency'] != $sCurrency )
            throw new Exception( 'transfer not found in history' );
        return $aTransfer['iID'];
    }
    private function paymentBank( $iProvider, array $aExtra, $dAmount, $sCurrency = 'RUB' ) {

        # ������������� ����� ������� :
        $dAmount = intval( str_replace( ',', '.', $dAmount ) * 100 ) / 100;
        $aAmount = explode( '.', $dAmount );
        if( !isset( $aAmount[1] ) )
            $aAmount[1] = '00';
        else if( strlen( $aAmount[1] ) != 2 )
            $aAmount[1] .= '0';
        
        # ������������� ������ aExtra :
        foreach( $aExtra as $sKey => $sValue ) {
            $aExtra["extra['".$sKey."']"] = $sValue;
            unset( $aExtra[$sKey] );
        }

        # ��������� �������� ���������� :
        $this->curl( 'payment/form.action?provider='.$iProvider );
        
        # ���������� FIELD ������� :
        if( ($aResponse = @json_decode( $this->curl( 
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => $aAmount[0],
                    'amountFraction' => $aAmount[1],
                    'arg_num' => '',
                    'currency' => $sCurrency,
                    'protected' => 'true',
                    'source' => 'qiwi_'.$sCurrency,
                    'state' => 'FIELD' 
                ), $aExtra )
            )
        ), true )) === false )
            throw new Exception( 'internal error, step 1' );
        if( !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : 'internal error, step 2' );
        $sResponse = $this->curl(
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => $aAmount[0],
                    'amountFraction' => $aAmount[1],
                    'arg_num' => '',
                    'currency' => $sCurrency,
                    'protected' => 'true',
                    'source' => 'qiwi_'.$sCurrency,
                    'state' => 'FIELD',
                    'token' => $aResponse['data']['token'],
                ), $aExtra )
            )
        );
        
        # ���������� CONFIRM ������� :
        if( ($aResponse = @json_decode( $this->curl( 
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => $aAmount[0],
                    'amountFraction' => $aAmount[1],
                    'arg_num' => '',
                    'currency' => $sCurrency,
                    'protected' => 'true',
                    'source' => 'qiwi_'.$sCurrency,
                    'state' => 'CONFIRM' 
                ), $aExtra )
            )
        ), true )) === false )
            throw new Exception( 'internal error, step 3' );
        if( !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : 'internal error, step 4' );
        $sResponse = $this->curl(
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => $aAmount[0],
                    'amountFraction' => $aAmount[1],
                    'arg_num' => '',
                    'currency' => $sCurrency,
                    'protected' => 'true',
                    'source' => 'qiwi_'.$sCurrency,
                    'state' => 'CONFIRM',
                    'token' => $aResponse['data']['token'],
                ), $aExtra )
            )
        );
        
        # ������ �� ��������� ������ ������������� ������� :
        if( ($aResponse = @json_decode( $this->curl( 'payment/form/state.action?state=PAY' ), true )) === false )
            throw new Exception( 'internal error, step 3' );
        
        # �������� ������� ������� :
        if( !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : 'internal error, step 4' );

        # ������������ ���������� ������� :
        $sResponse = $this->curl(
            'payment/form/state.action',
            array(
                'token' => $aResponse['data']['token'],
                'state' => 'PAY'
            )
        );

        # ���� ������ ��� �� ������� :
        if( mb_strpos( $sResponse, 'transaction":"' ) === false ) {
            if( mb_strpos( $sResponse, 'class="errorElement"' ) !== false ) {
                $aExplode = explode( 'class="errorElement">', $sResponse );
                $aExplode = explode( '</', $aExplode[1] );
                throw new Exception( trim( $aExplode[0] ) );
            }
            else {
                if( count( $sMessage = explode( '<p>', $sResponse ) ) < 2 )
                    throw new Exception( 'unknown error' );
                $sMessage = explode( '</p>', $sMessage[1] );
                throw new Exception( $sMessage[0] );
            }
        }

        $aHistory = $this->GetHistory( date( 'd.m.Y', strtotime( '-1 day' ) ), date( 'd.m.Y', strtotime( '+1 day' ) ) );
        $aTransfer = array_shift( $aHistory );
        if( $aTransfer === false || $aTransfer['dAmount'] != $dAmount || $aTransfer['sCurrency'] != $sCurrency )
            throw new Exception( 'transfer not found in history' );
        return $aTransfer['iID'];
    }
    
    # ����� : ����������� ID ���������� ������ �� ������ ���������� �����.
    public function getCardProvider( $iCard ) {
        
        # �������� ����� :
        $this->curl( 'payment/form.action?provider=1963' );
        
        # ��������������� ������ :
        if( ($aResponse = @json_decode( $this->curl( 
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => 10,
                    'amountFraction' => 0,
                    'arg_num' => '',
                    'currency' => 'RUB',
                    'protected' => 'true',
                    'source' => 'qiwi_RUB',
                    'state' => 'FIELD' 
                ), array( "extra['account']" => $iCard ) )
            )
        ), true )) === false )
            throw new Exception( 'internal error, step 1' );
        if( !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : 'internal error, step 2' );

        # ������ ������������� :
        $sResponse = $this->curl(
            'user/payment/form/state.action?'.http_build_query( 
                array_merge( array(
                    'amountInteger' => 10,
                    'amountFraction' => 1,
                    'arg_num' => '',
                    'currency' => 'RUB',
                    'protected' => 'true',
                    'source' => 'qiwi_RUB',
                    'state' => 'FIELD',
                    'token' => $aResponse['data']['token'],
                ), array( "extra['account']" => $iCard ) )
            )
        );
        if( count( $aExplode = explode( '{"provider":', $sResponse ) ) < 2 || count( $aExplode = explode( ',', $aExplode[1] ) ) < 2 )
            throw new Exception( 'provider not found' );
        return trim( $aExplode[0] ) - 0;
    }
     private function curl( $sPath, $mPOST = null, array $aOptions = null ) {
        
        # ������������� ����������� ���������� :
        static $sReferer = null;
        
        # ������������� ���������� :
        $oCurl = curl_init( mb_substr( $sPath, 0, 4 ) == 'http' ? $sPath : 'https://qiwi.com/'.$sPath );
        
        # ��������� cURL :
        curl_setopt_array( $oCurl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIEJAR => $this->sCookieFile,
            CURLOPT_COOKIEFILE => $this->sCookieFile,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => mb_substr( $sPath, 0, 4 ) == 'http' ? (is_null( $mPOST ) ? array( 'Accept: application/json, text/javascript, */*; q=0.01', 'X-Requested-With: XMLHttpRequest' ) : array( 'Content-Type: application/json; charset=UTF-8' )) : array( 'Accept: application/json, text/javascript, */*; q=0.01', 'X-Requested-With: XMLHttpRequest' ),
        ) );
        
        # ���� ��������� ��������� POST - ������ :
        if( is_array( $mPOST ) || $mPOST != '' || mb_substr( $sPath, 0, 4 ) != 'http' ) {
            
            # ��������� Curl ����������� :
            curl_setopt_array( $oCurl, array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => is_array( $mPOST ) ? http_build_query( $mPOST ) : $mPOST,
            ) );
        }
        
        # ���� ���������� ������� :
        if( !is_null( $sReferer ) )
            curl_setopt( $oCurl, CURLOPT_REFERER, $sReferer );
        
        # ���� ��������� ������� �������������� ��������� :
        if( is_array( $aOptions ) && count( $aOptions ) )
            curl_setopt_array( $oCurl, $aOptions );
        
        # ���� ��������� �������� ����� Proxy :
        if( $this->sProxy != '' ) {
            
            # ��������� ������ �� ��������� � ������ :
            $aExplode = explode( ':', $this->sProxy );
            
            # ���� ������ ������� > 2 :
            if( count( $aExplode ) > 2 ) {
                
                # ����������� proxy � curl:
                curl_setopt_array( $oCurl, array(
                    CURLOPT_PROXY => $aExplode[0].':'.$aExplode[1],
                    CURLOPT_HTTPPROXYTUNNEL => true,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_PROXYTYPE => $aExplode[2] == 'socks5' ? CURLPROXY_SOCKS5 : ($aExplode[2] == 'socks4' ? CURLPROXY_SOCKS4 : CURLPROXY_HTTP)
                ) );
                
                # ���� ������ ������� ������ 4 :
                if( count( $aExplode ) > 4 ) {
                    
                    # ����������� � proxy � curl:
                    curl_setopt( $oCurl, CURLOPT_PROXYUSERPWD, $aExplode[3].':'.$aExplode[4] );
                }
            }          
        }

        # ��������� ������ :
        $this->sResponse = curl_exec( $oCurl );
        
        # ���� ��������� ������ :
        if( curl_errno( $oCurl ) )
            throw new Exception( curl_errno( $oCurl ).' - '.curl_error( $oCurl ) );
        
        # ��������� ���������� :
        curl_close( $oCurl );
        
        # ��������� �������� referer :
        $sReferer = mb_substr( $sPath, 0, 4 ) == 'http' ? $sPath : 'https://qiwi.com/'.$sPath;
        
        # �������������� ������ � ������ :
        $this->aResponse = json_decode( $this->sResponse, true );
        if( json_last_error() != JSON_ERROR_NONE )
            $this->aResponse = array();
        
        return $this->sResponse;
    }
    public function phoneToProvider( $iPhone ) {
        $aResponse = json_decode( $this->curl( 'mobile/detect.action', array( 'phone' => '+'.$iPhone ) ), true );
        if( !isset( $aResponse['code'] ) || !isset( $aResponse['code']['_name'] ) )
            throw new Exception( json_encode( $aResponse ) );
        if( $aResponse['code']['_name'] != 'NORMAL' )
            throw new Exception( $aResponse['message'] );
        return $aResponse['message'] - 0;
    }
    public function payPhone( $iPhone, $dAmount, $sComment ) {
        
        # ���������� ��������� �� ������ :
        $iProvider = $this->phoneToProvider( $iPhone );
                
        return $this->payment( $iProvider, array( 'account' => substr( $iPhone, 1 ), 'comment' => $sComment ), $dAmount );
    }
    public function isSMSAcive() {
        $sResponse = $this->curl( 'options/security.action' );
        $aExplode = explode( 'SMS_CONFIRMATION', $sResponse );
        if( count( $aExplode ) < 3 )
            throw new Exception( 'error check sms confirmation' );
        return strpos( $aExplode[1], 'display' ) === false;
    }
  
  
   public function createEgg( $dAmount, $sComment ) {
        return $this->payment( 22496, array( 'account' => '708', 'comment' => $sComment, 'to_account' => '', 'to_account_type' => 'undefind' ), $dAmount );
    }
		
    public function activateEgg( $sCode ) {
        
        # ���� ��� �� ������ :
        if( $sCode == '' )
            throw new Exception( '��� ������� �� ������' );
        
        # ������������� ���������� :
        $aResult = array(); # �������������� ������
        
        # �������� �������� :
        $this->curl( 'user/eggs/activate/content/form.action', array( 'code' => $sCode ) );
        
        # ���� ��� ������� ������ :
        if( !isset( $this->aResponse['data'] ) || !isset( $this->aResponse['data']['token'] ) )
            throw new Exception( 'error in step 1' );

        # �������� �������� :
        $this->curl( 'user/eggs/activate/content/form.action', array( 'code' => $sCode, 'token' => $this->aResponse['data']['token'] ) );

        # ���� ���������� �� ��������� :
        if( mb_substr_count( $this->sResponse, $sCode ) != 2 ) {
            if( count( $aExplode = explode( '<p>', $this->sResponse ) ) < 3 )
                throw new Exception( 'undefined error' );
            $aExplode = explode( '</', $aExplode[2] );
            throw new Exception( trim( strip_tags( $aExplode[0] ) ) );
        }
        
        # ������� ����� :
        if( count( $aExplode = explode( '�� �����', $this->sResponse ) ) < 2 )
            throw new Exception( 'error parse amount' );
        $aExplode = explode( '���', $aExplode[1] );
        $aResult['dAmount'] = preg_replace( '/[^0-9\.]+/', '', str_replace( ',', '.', trim( $aExplode[0] ) ) ) - 0;
        
        # ������� ���������� :
        if( count( $aExplode = explode( '����������� � ��������', $this->sResponse ) ) < 2 )
            throw new Exception( 'error parse comment' );
        $aExplode = explode( '</p>', $aExplode[1] );
        $aResult['sComment'] = trim( strip_tags( $aExplode[0] ) );

        # ������ � ������� :
        $this->curl( 'user/eggs/activate/content/activate.action', array( 'code' => $sCode ) );
        
        # �������� ������������� :
        if( !isset( $this->aResponse['code'] ) || !isset( $this->aResponse['code']['value'] ) || !isset( $this->aResponse['code']['_name'] ) || $this->aResponse['code']['value'] != '0' || $this->aResponse['code']['_name'] != 'NORMAL' )
            throw new Exception( 'bad server answer: '.var_export( $this->aResponse, true ) );

        return $aResult;
    }
	
	
	
    
    # ����� : ������ �� ����� ������.
    # ���������� : ������������� �������.
    public function requestChangePassword() {
        
        # ��������� �������� :
        $this->curl( 'options/password.action' );
        
        # ��������� �������� :
        $aResponse = json_decode( $this->curl( 'user/person/change/password.action' ), true );
        
        # ������������� ���������� :
        $iIdentifier = isset( $aResponse['identifier'] ) ? $aResponse['identifier'] - 0 : 0;
        
        # ���� ���� <= 0 :
        if( $iIdentifier <= 0 )
            throw new Exception( 'field identifier not found' );
        
        # ��������� �������� :
        $this->curl( 'user/confirmation/form.action', array(
            'identifier' => $iIdentifier,
            'type' => 'PASSWORD_CHANGE'
        ) );
        
        return $iIdentifier;
    }
    
    # ����� : ������������� ����� ������.
    # ��������� : ������������� �������, ������ ������, ����� ������, ��� � sms.
    public function progressChangePassword( $iIdentifier, $sOldPassword, $sNewPassword, $iCode ) {
        
        # ��������� �������� :
        $aResponse = json_decode( $this->curl( 'user/confirmation/confirm.action', array(
            'code' => $iCode,
            "data['newPassword']" => $sNewPassword,
            "data['oldPassword']" => $sOldPassword,
            "data['period']" => 4,
            'identifier' => $iIdentifier,
            'type' => 'PASSWORD_CHANGE'
        ) ), true );
        
        # �������� �� ������� ������ :
        if( !isset( $aResponse['code'] ) || !isset( $aResponse['code']['value'] ) || $aResponse['code']['value'] != 0 )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : json_encode( $aResponse ) );
    }
   
    # ����� : ������ �� ���������� SMS ������������� ��������.
    # ��������� : ��������� ���������?
    # ���������� : ������������� �������������.
    public function requestConfirmPayments( $bOff = true ) {
        
        # �������� �������� :
        $this->curl( 'settings/options/security.action' );
        
        # �������� �������� :
        $aResponse = json_decode( $this->curl( 'user/person/change/security.action', array(
            'type' => 'SMS_CONFIRMATION',
            'value' => $bOff ? 'false' : 'true' 
        ) ), true );
        
        # �������� ������ :
        if( !isset( $aResponse['code'] ) || !isset( $aResponse['code']['value'] ) || $aResponse['code']['value'] != 7 || !isset( $aResponse['data'] ) || !isset( $aResponse['data']['token'] ) )
            throw new Exception( json_encode( $aResponse ) );
        
        # ������������� ���������� :
        $sToken = $aResponse['data']['token'];
        
        # �������� �������� :
        $aResponse = json_decode( $this->curl( 'user/person/change/security.action', array(
            'token' => $sToken,
            'type' => 'SMS_CONFIRMATION',
            'value' => $bOff ? 'false' : 'true'
        ) ), true );
        
        # �������� ������ :
        if( isset( $aResponse['code'] ) && isset( $aResponse['code']['value'] ) && $aResponse['code']['value'] == 0 )
            return true;
        
        # �������� ������ :
        if( !isset( $aResponse['code'] ) || !isset( $aResponse['code']['value'] ) || $aResponse['code']['value'] != 4 || !isset( $aResponse['identifier'] ) || $aResponse['identifier'] <= 0 )
            throw new Exception( json_encode( $aResponse ) );
        
        # ������������� ���������� :
        $iIdentifier = $aResponse['identifier'];
        
        # �������� �������� :
        $this->curl( 'user/confirmation/form.action', array(
            'identifier' => $iIdentifier,
            'token' => $sToken,
            'type' => 'SMS_CONFIRMATION',
            'value' => $bOff ? 'false' : 'true'
        ) );
        
        return $iIdentifier;
    }
    
    # ����� : ������������� ���������� SMS ������������� ��������.
    # ��������� : ������������� �������, ��� � sms.
    public function progressConfirmPayments( $iIdentifier, $iCode ) {
        
        # �������� �������� :
        $aResponse = json_decode( $this->curl( 'user/confirmation/confirm.action', array(
            'code' => $iCode,
            'identifier' => $iIdentifier,
            'type' => 'SMS_CONFIRMATION'
        ) ), true );
        
        # �������� �� ������� ������ :
        if( !isset( $aResponse['code'] ) || !isset( $aResponse['code']['value'] ) || $aResponse['code']['value'] != 0 )
            throw new Exception( isset( $aResponse['message'] ) ? $aResponse['message'] : json_encode( $aResponse ) );
    }
    
    # ����� : SMS ������������� ��������.
    public function paymentSMSConfirm( $iCode ) {
        
        # �������� �������� :
        $aResponse = json_decode( $this->curl( 'user/payment/form/state.action', array(
            'confirmationCode' => $iCode,
            'protected' => 'true',
            'state' => 'PAY'
        ) ), true );
        
        # �������� �������� :
        $sResponse = $this->curl( 'user/payment/form/state.action', array(
            'confirmationCode' => $iCode,
            'protected' => 'true',
            'state' => 'PAY',
            'token' => $aResponse['data']['token']
        ) );
   
        # ���� ������ ��� �� ������� :
        if( mb_strpos( $sResponse, 'transaction":"' ) === false ) {
            if( mb_strpos( $sResponse, 'class="errorElement"' ) !== false ) {
                $aExplode = explode( 'class="errorElement">', $sResponse );
                $aExplode = explode( '</', $aExplode[1] );
                throw new Exception( trim( $aExplode[0] ) );
            }
            if( count( $sMessage = explode( '<p>', $sResponse ) ) < 2 )
                throw new Exception( 'unknown error' );
            $sMessage = explode( '</p>', $sMessage[1] );
            throw new Exception( $sMessage[0] );
        }
        
        # ���� ��� ���� :
        if( count( $aExplode = explode( '��� �������:', $sResponse ) ) > 1 ) {
            $aExplode = explode( '<', $aExplode[1] );
            return trim( $aExplode[0] );
        }
        
        # ������� � ���������� :
        $aExplode = explode( 'transaction":"', $sResponse );
        $aExplode = explode( '"', $aExplode[1] );
        return $aExplode[0];
    }
    
    # ����� : ������� cookie.
    public function clearCookie() {
        
        # ������� ����������� ����� :
        file_put_contents( $this->sCookieFile, '' );
    }
}