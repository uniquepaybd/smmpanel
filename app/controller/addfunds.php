//uniquepaybd Header file start --


             if(isset($_GET['successone'])){
                  $DB_HOST = 'localhost';
                  $DB_USER = 'ovismmpa_smm';
                  $DB_PASS = 'ovismmpa_smm';
                  $DB_NAME = 'ovismmpa_smm';
                  
                   $url = constant("URL");
                  
                  $sqlconn=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
                  
                  $user_idssss = $user['email'];
                  
                  $amount_session = $_GET['successone'];
                  
                    $transactionId = $_GET['transactionId'];
                    $paymentAmount = $_GET['paymentAmount'];
                    $paymentFee = $_GET['paymentFee'];

                    $transaction_id_uniquepaybd = $transactionId;

                    $data   = array(
                        "transaction_id"        => $transaction_id_uniquepaybd,
                    );

                    $apikey = $_GET['api'];
                    $secretkey = $_GET['secret'];
                    $hostname = $_GET['host'];

                    $header   = array(
                        "api"               => $apikey,
                        "secret"            => $secretkey,
                        "position"          => $hostname,
                        "url"               => 'https://pay.uniquepaybd.com/request/payment/verify',
                    );
                    $headers = array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'app-key: ' . $header['api'],
                        'secret-key: ' . $header['secret'],
                        'host-name: ' . $header['position'],
                    );
                    $url1 = $header['url'];
                    $curl = curl_init();
                    $data = http_build_query($data);
                    
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url1,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => $headers,
                        CURLOPT_VERBOSE =>true
                    ));
                     
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $data = json_decode($response,true);
                    
                    if($data['status'] == 1){
                          $date_doka = date("Y.m.d H:i:s");
                          $client_ids = $user['client_id'];
                          $get_id = GetIP();
                          
                          $insert_history = "INSERT INTO payments (client_id,payment_amount,payment_privatecode,payment_method,payment_mode,payment_create_date,payment_ip,payment_extra,payment_status) VALUES ('$client_ids','$amount_session','0','44','Otomatik','$date_doka','$get_id','Check uniquepaybd','3')";
                          mysqli_query($sqlconn,$insert_history);
                          
                          $sql = "UPDATE clients SET `balance`=`balance`+$amount_session WHERE email='$user_idssss'";
                          if(mysqli_query($sqlconn,$sql)){
            ?>
                            <script>
                                location.href="<?php echo $url?>/addfunds";
                            </script>
            <?php
                          }
                    }else{
                         echo "Failed. Id Not Match";
                    }
             }
            
//uniquepaybd header file end 








            //body of uniquepaybd start --

             elseif ($method_id == 44):
            
            $start_amount = $extra['currency_rate']*$amount;
            $total_amount = $start_amount;
            
            $total_amount = number_format((float) $total_amount, 2, ".", "");

            $amounts = $total_amount;

            $apikey = $extra['api_key']; //Your Api Key
            $secretkey = $extra['secret_key']; //Your Secret Key

            $cus_name = isset($user['first_name'])?$user['first_name']:'John';
            $cus_email = $user['email'];

            
          //success url
            $hostname = $extra['host_name'];
            
            $success_url = site_url('addfunds?successone=').$amount.'&api='.$apikey.'&host='.$hostname.'&secret='.$secretkey;
            //cancel url
            $cancel_url = site_url('addfunds?canncel=true');

            $data   = array(
                "cus_name"          => $cus_name,
                "cus_email"         => $cus_email,
                "amount"            => $amounts ,
                "success_url"       => $success_url,
                "cancel_url"        => $cancel_url,
            );

            $header   = array(
                "api"               => $apikey,
                "secret"            => $secretkey,
                "position"          => $hostname,
                "url"               => 'https://pay.uniquepaybd.com/request/payment/create',
            );
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
                'app-key: ' . $header['api'],
                'secret-key: ' . $header['secret'],
                'host-name: ' . $header['position'],
            );
            $url = $header['url'];
            $curl = curl_init();
            $data = http_build_query($data);
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_VERBOSE =>true
            ));
             
            $response = curl_exec($curl);
            curl_close($curl);
            
            echo $response;
            
            //end uniquepaybd body
