                  //  uniquepaybd Coding   
                    elseif (($action == 'edit_paymentmethod') && ($_POST['id'] == 'uniquepaybd')) :
                        $id = $_POST['id'];
                        $method = $conn->prepare('SELECT * FROM payment_methods WHERE method_get=:id ');
                        $method->execute(['id' => $id]);
                        $method = $method->fetch(PDO::FETCH_ASSOC);
                        $extra = json_decode($method['method_extras'], true);
                        $return = '<form class="form" action="' . site_url('admin/settings/payment-methods/edit/' . $id) . '" method="post" data-xhr="true">' . "\r\n\r\n" . '<div class="modal-body">' . "\r\n\r\n" . ' <div class="form-group">' . "\r\n" . '  <label class="form-group__service-name">Method name</label>' . "\r\n" . '  <input type="text" class="form-control" readonly value="' . $method['method_name'] . '">' . "\r\n" . ' </div>' . "\r\n\r\n" . ' <div class="service-mode__block">' . "\r\n" . '  <div class="form-group">' . "\r\n" . '  <label>Visibility</label>' . "\r\n" . '<select class="form-control" name="method_type">' . "\r\n" . '  <option value="2"';

                        if ($method['method_type'] == 2) {
                            $return .= 'selected';
                        }

                        $return .= '>Active</option>' . "\r\n" . '  <option value="1"';

                        if ($method['method_type'] == 1) {
                            $return .= 'selected';
                        }

                        $return .= '>Inactive</option>' . "\r\n" . '</select>' . "\r\n" . '  </div>' . "\r\n" . ' </div>' . "\r\n\r\n" . ' <div class="form-group">' . "\r\n" . '  <label class="form-group__service-name">Visible name</label>' . "\r\n" . '  <input type="text" class="form-control" name="name" value="' . $extra['name'] . '">' . "\r\n" . ' </div>' . "\r\n\r\n" . ' <div class="form-group">' . "\r\n" . '  <label class="form-group__service-name">Minimum Payment</label>' . "\r\n" . '  <input type="text" class="form-control" name="min" value="' . $extra['min'] . '">' . "\r\n" . ' </div>' . "\r\n\r\n" . ' <div class="form-group">' . "\r\n" . '  <label class="form-group__service-name">Maximum Payment</label>' . "\r\n" . '  <input type="text" class="form-control" name="max" value="' . $extra['max'] . '">' . "\r\n" . ' </div>' . "\r\n\r\n" . ' <hr>' . "\r\n" . '  <p class="card-description">' . "\r\n" . '<ul>' . "\r\n" . '<li>' . "\r\n" . ' API callback address: <code>';
                        $return .= site_url('payment/' . $method['method_get']);
                        $return .= '</code>' . "\r\n" . '</li>' . "\r\n" . '</ul>' . "\r\n" . '  </p>' . "\r\n" . ' <hr>' . "\r\n\r\n" . ' <div class="form-group">' . "\r\n" . '  <label class="form-group__service-name">API Key</label>' . "\r\n" . '  <input type="text" class="form-control" name="api_key" value="' . $extra['api_key'] . '">' . "\r\n" . ' </div>' . "\r\n" . '<div class="form-group">' . "\r\n" . '  <label class="form-group__service-name">Secret Key</label>' . "\r\n" . '  <input type="text" class="form-control" name="secret_key" value="' . $extra['secret_key'] . '">' . "\r\n" . "\r\n" . ' </div>' .'<div class="form-group">' .  '  <label class="form-group__service-name">Host Name</label>' . "\r\n" . '  <input type="text" class="form-control" name="host_name" value="' . $extra['host_name'] . '">' . "\r\n" . ' </div>' .'<div class="form-group">' .  '  <label class="form-group__service-name">Currency Rate</label>' . "\r\n" . '  <input type="text" class="form-control" name="currency_rate" value="' . $extra['currency_rate'] . '">' . "\r\n" . ' </div>' . "\r\n\r\n\r\n" . '</div>' . "\r\n\r\n" . ' <div class="modal-footer">' . "\r\n" . '  <button type="submit" class="btn btn-primary">Update</button>' . "\r\n" . '  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>' . "\r\n" . ' </div>' . "\r\n" . ' </form>';
                        echo json_encode(['content' => $return, 'title' => '']);

                      //uniquepaybd Coding-->
