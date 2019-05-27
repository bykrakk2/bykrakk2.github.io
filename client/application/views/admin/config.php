<? if(isset($error)) { echo $error; } elseif(isset($ok)) { echo '<div class="alert alert-success">Данные успешно сохранены!</div>';  header("Location: /admin/config");} ?>
<? echo validation_errors(); echo $info ?>
<? echo form_open_multipart(); ?>
<style> .form-group {margin-bottom: 15px;margin-top: 30px;} </style>

<section class="content">
   <div class="row">
      <div class="col-md-3">
         <div class="box">
            <div class="box-header with-border">
               <h3 class="box-title">Оплата</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Свернуть">
              <i class="fa fa-minus"></i></button>
          </div>
            </div>
            <div class="box-body">
               <table class="table">
                  <tr>
                     <td>WebMoney:</td>
                     <td>
                        <input class="tgl tgl-flat" name="site_pwebmoney" id="cb1" type="checkbox" <? if (config_item('site_pwebmoney') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb1"></label>
                     </td>
                  </tr>
                  <tr>
                     <td>QIWI:</td>
                     <td>
                        <input class="tgl tgl-flat" name="site_pqiwi" id="cb2" type="checkbox" <? if (config_item('site_pqiwi') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb2"></label>
                     </td>
                  </tr>

                  <tr>
                     <td>Yandex.Money:</td>
                     <td>
                        <input class="tgl tgl-flat" name="site_pyandex" id="cb3" type="checkbox" <? if (config_item('site_pyandex') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb3"></label>
                     </td>
                  </tr>

                  <tr>
                     <td>Free-kassa:</td>
                     <td>
                        <input class="tgl tgl-flat" name="site_pkassa" id="cb4" type="checkbox" <? if (config_item('site_pkassa') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb4"></label>
                     </td>
                  </tr>

                  <tr>
                     <td>Interkassa:</td>
                     <td>
                        <input class="tgl tgl-flat" name="ik_status" id="cb5" type="checkbox" <? if (config_item('ik_status') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb5"></label>
                     </td>
                  </tr>
                  <tr>
                     <td>Payeer:</td>
                     <td>
                        <input class="tgl tgl-flat" name="pr_status" id="cb6" type="checkbox" <? if (config_item('pr_status') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb6"></label>
                     </td>
                  </tr>
                  <tr>
                     <td>Robokassa:</td>
                     <td>
                        <input class="tgl tgl-flat" name="rk_status" id="cb7" type="checkbox" <? if (config_item('rk_status') == 1){echo "checked";} ?>>
                        <label class="tgl-btn" for="cb7"></label>
                     </td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
               </table>
            <div class="box-header with-border">
               <h3 class="box-title">Общие настройки</h3>
			   
            </div>
			      <div class="input-group">
                  <? $list = array( '1' => 'Страница', '2' => 'Модальное окно', ); ?>
				  <?php echo form_dropdown('block_1', $list, $this->config->item('block_1'),'class="form-control"'); ?>
				  <span class="input-group-addon"><i class="fa fa-cog"></i></span>
               </div>
			   <br>
               <? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary" style=" width: 100%; "'); ?>
            </div>
         </div>
      </div>
      <div class="col-md-9">
         <div class="box">
            <div class="box-header with-border">
               <h3 class="box-title">Настройка оплаты</h3>
            </div>
            <div>
               <div class="panel-body" style="display: block;">
                  <div class="nav-tabs-custom">
                     <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Free-kassa</a></li>

                        <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Yandex</a></li>

                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">WebMoney</a></li>
                        <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Qiwi</a></li>

                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Interkassa</a></li>
                         <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">Payeer</a></li>
						 <li class=""><a href="#tab_8" data-toggle="tab" aria-expanded="false">Robokassa</a></li>

                     </ul>
                     <div class="tab-content">
                        <div id="tab_1" class="tab-pane active">
                           <div class="box-body">
						   <h3>Настройки Free-kassa</h3>
						   <hr>
                              <li>
                                 Укажите следующите данные в настройках Free-kassa
                                 <hr>
                                 <ul>
                                    <li><b>Название сайта</b> :  Укажите любое название
                                    </li>
                                    <li><b>URL сайта</b> :  http://<? echo $_SERVER['HTTP_HOST'] ; ?>/
                                    </li>
                                    <li><b>URL оповещения</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/checkpay
                                    </li>
                                    <li><b>URL возврата в случае успеха</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata?status=1 
                                    </li>
                                    <li><b>URL возврата в случае неудачи</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata
                                    </li>
                                 </ul>
                              </li>
                              <br>
                              <label for="login">id магазина Free-kassa</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                 <? echo form_input( 'f_id', set_value( 'f_id', $this->config->item('f_id')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <label for="login">Секретное слово</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                 <? echo form_input( 'f_key_1', set_value( 'f_key_1', $this->config->item('f_key_1')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <label for="login">Секретное слово 2</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                 <? echo form_input( 'f_key_2', set_value( 'f_key_2', $this->config->item('f_key_2')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary "'); ?>
                           </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                           <div class="box-body">
						   <h3>Настройки Interkassa</h3>
						   <hr>
                              <li>
                                 Укажите следующите данные в настройках Interkassa
                                 <hr>
                                 Интерфэйс
                                 <ul>
                                    <li><b>URL успешной оплаты </b> :  http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata
                                    </li>
                                    <li><b>URL неуспешной оплаты </b> :  http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata
                                    </li>
                                    <li><b>URL ожидания проведения платежа </b> :  http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata
                                    </li>
                                    <li><b>URL оповещения</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/checkpay/ik
                                    </li>
                                 </ul>
                                 Безопасность
                                 <ul>
                                    <li><b>Проверять подпись в форме запроса платежа </b> :  Да
                                    </li>
                                 </ul>
                              </li>
                              <br>
                              <label for="login">id магазина Interkassa</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                                 <? echo form_input( 'ik_id', set_value( 'ik_id', $this->config->item('ik_id')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <label for="login">Секретный ключ</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                 <? echo form_input( 'ik_key', set_value( 'ik_key', $this->config->item('ik_key')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <label for="login">Тестовый ключ</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                 <? echo form_input( 'ik_test', set_value( 'ik_test', $this->config->item('ik_test')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary "'); ?>
                           </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                           <div class="box-body">
						   <h3>Настройки Webmoney</h3>
						   <hr>
                              <div class="alert alert-info">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                 Выберите ключ-файл вашего кошелька. Подробнее <a target="_BLANK" href="http://wiki.webmoney.ru/projects/webmoney/wiki/%D0%A4%D0%B0%D0%B9%D0%BB_%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%B9">тут</a>.
                              </div>
                              <input type="hidden" name="configure" id="input" class="form-control" value="webmoney">
                              <label for="userfile">Ключ-файл .kwm</label>
                              <input name="userfile" id="userfile" type="file" accept=".kwm">
                              <? echo $this->config->item('wm_key_date') ;?>
                              <br>
                              <label for="wm_pass">Пароль от ключ-файла</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                 <? echo form_password( 'wm_pass', set_value( 'wm_pass', '******'), 'class="form-control"'); ?>
                              </div>
                              <br>
                              <label for="purse">Номер кошелька WMR</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                 <? echo form_input( 'WMR', set_value( 'WMR', $this->config->item('WMR')),'class="form-control inputmask"'); ?>
                              </div>
                              <br>
							  <label for="purse">Номер кошелька WMZ</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                 <? echo form_input( 'WMZ', set_value( 'WMZ', $this->config->item('WMZ')),'class="form-control inputmask"'); ?>
                              </div>
                              <br>
							  <label for="purse">Номер кошелька WMU</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                 <? echo form_input( 'WMU', set_value( 'WMU', $this->config->item('WMU')),'class="form-control inputmask"'); ?>
                              </div>
                              <br>
                              <label for="wmid"><a target="_BLANK" href="http://wiki.webmoney.ru/projects/webmoney/wiki/wmid">WMID</a>
                              </label>
                              <div class="input-group">
                                 <span class="input-group-addon">WMID</span>
                                 <? echo form_input( 'wmid', set_value( 'wmid', $this->config->item('wmid')),'class="form-control inputmask"'); ?>
                              </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary "'); ?>
                           </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_5">
                           <div class="box-body">
						   <h3>Настройки Qiwi</h3>
						   <hr>
                              <input type="hidden" name="configure" id="input" class="form-control" value="qiwi">
                              <label for="login">Номер телефона (Логин без <i class="fa fa-plus"></i>)&nbsp;&nbsp;</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                 <? echo form_input( 'qiwi_num', set_value( 'qiwi_num', $this->config->item('qiwi_num')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <label for="password">Пароль</label>
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                 <? echo form_password( 'qiwi_pass', set_value( 'qiwi_pass', '******'), 'class="form-control"'); ?>
                              </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary "'); ?>
                           </div>
                        </div>
                        <div class="tab-pane" id="tab_7">
                           <div class="box-body">
						    <h3>Настройки Payeer</h3>
							<hr>
                              <li>
                                 Укажите следующите данные в настройках Payeer
                                 <hr>
                                 <ul>
                                    <li><b>Название сайта</b> :  Укажите любое название
                                    </li>
                                    <li><b>URL сайта</b> :  http://<? echo $_SERVER['HTTP_HOST'] ; ?>/
                                    </li>
                                    <li><b>URL оповещения</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/checkpay/payeer
                                    </li>
                                    <li><b>URL возврата в случае успеха</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata?status=1 
                                    </li>
                                    <li><b>URL возврата в случае неудачи</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata
                                    </li>
                                 </ul>
                              </li>
                      <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label"> ID payeer </label>
                           <div class="col-sm-10">
						   <div class="input-group">
						      <? echo form_input( 'pr_id', set_value( 'pr_id', $this->config->item('pr_id')),'class="form-control"'); ?>
							  <span class="input-group-addon"><i class="fa fa-shopping-bag"></i></span>
							</div>
                           </div>
                           <!-- .input-group -->
                        </div>
						<br>
                      <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label"> Секретный ключ </label>
                           <div class="col-sm-10">
						   <div class="input-group">
						      <? echo form_input( 'pr_key', set_value( 'pr_key', $this->config->item('pr_key')),'class="form-control"'); ?>
							  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
							</div>
                           </div>
                           <!-- .input-group -->
                        </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" style=" margin-top: 22px; margin-left: 14px; " class="btn btn-primary "'); ?><a class="btn btn-info " href="?set=pr" style=" margin-top: 22px; margin-left: 14px; "> Создать файл активации </a>
                           </div>
                        </div>
						
                        <div class="tab-pane" id="tab_8">
                           <div class="box-body">
						    <h3>Настройки Robokassa</h3>
							<hr>
                              <li>
                                 Укажите следующите данные в настройках Robokassa
                                 <hr>
                                 <ul>
                                    <li><b>Название сайта</b> :  Укажите любое название
                                    </li>
                                    <li><b>Result URL</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/checkpay/rk
                                    </li>
                                    <li><b>Success URL </b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata?status=1 
                                    </li>
                                    <li><b>Fail URL</b> : <i class="fa fa-info"></i> http://<? echo $_SERVER['HTTP_HOST'] ; ?>/oplata
                                    </li>
                                 </ul>
                              </li>
                      <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label"> Идентификатор магазина </label>
                           <div class="col-sm-10">
						   <div class="input-group">
						      <? echo form_input( 'rk_login', set_value( 'rk_login', $this->config->item('rk_login')),'class="form-control"'); ?>
							  <span class="input-group-addon"><i class="fa fa-shopping-bag"></i></span>
							</div>
                           </div>
                           <!-- .input-group -->
                        </div>
						<br>
                      <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label"> Пароль #1  </label>
                           <div class="col-sm-10">
						   <div class="input-group">
						      <? echo form_input( 'rk_password_1', set_value( 'rk_password_1', $this->config->item('rk_password_1')),'class="form-control"'); ?>
							  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
							</div>
                           </div>
                           <!-- .input-group -->
                        </div><br>
                      <div class="form-group">
                           <label for="inputEmail3" class="col-sm-2 control-label"> Пароль #2 </label>
                           <div class="col-sm-10">
						   <div class="input-group">
						      <? echo form_input( 'rk_password_2', set_value( 'rk_password_2', $this->config->item('rk_password_2')),'class="form-control"'); ?>
							  <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
							</div>
                           </div>
                           <!-- .input-group -->
                        </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" style=" margin-top: 22px; margin-left: 14px; " class="btn btn-primary "'); ?>
                           </div>
                        </div>
                        <div class="tab-pane" id="tab_6">
                           <div class="box-body">
                              <div class="alert alert-info">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                 <strong>Внимание!</strong> Пожалуйста внимательно прочитайте и следуйте указаниям!
                              </div>
                              <ul style="list-style-type: decimal;">
                                 <li>Сначала создайте приложение в Яндекс.Деньги <a href="https://sp-money.yandex.ru/myservices/new.xml" target="_BLANK">(нажмите сюда для перехода)</a>
                                 </li>
                                 <li>
                                    Укажите следующите данные
                                    <ul>
                                       <li><b>НАЗВАНИЕ ПРИЛОЖЕНИЯ:</b> <font color="#aaaa00"><i class="fa fa-info"></i> Укажите любое название</font>
                                       </li>
                                       <li><b>АДРЕС ВАШЕГО САЙТА</b>: <u><font color="#0000dd">http://<? echo $_SERVER['HTTP_HOST'] ; ?></font></u>
                                       </li>
                                       <li><b>REDIRECT URI</b>: <u><font color="#dd0000">http://<? echo $_SERVER['HTTP_HOST'] ; ?>/yandex/token</font></u>
                                       </li>
                                       <li><b>Использовать проверку подлинности приложения: </b> <font color="red"><i class="fa fa-minus-square"></i> Нет </font>
                                       </li>
                                    </ul>
                                 </li>
                                 <li>Вставьте полученный идентификатор приложения в поле ниже и нажмите сохранить . После сохранение получите токен приложения по ссылке <a href="http://<? echo $_SERVER['HTTP_HOST'] ; ?>/yandex/" target="_BLANK">(нажмите сюда для перехода)</a>
                                 </li>
                              </ul>
                              <h4>После создания введите следующее</h4>
                              <input type="hidden" name="configure" id="input" class="form-control" value="yandex">
                              <div class="input-group">
                                 <span class="input-group-addon">Идентификатор приложения</span>
                                 <? echo form_input( 'yad_client_id', set_value( 'yad_client_id', $this->config->item('yad_client_id')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <div class="input-group">
                                 <span class="input-group-addon">Токен <u>приложения</u></span>
                                 <? echo form_input( 'yad_token', set_value( 'yad_token', $this->config->item('yad_token')),'class="form-control"'); ?>
                              </div>
                              <br>
                              <? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary "'); ?>
                           </div>
                        </div>
                     </div>
                     <!-- /.tab-content -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<? echo form_close(); ?>