<?php
require_once 'Mage/Customer/controllers/AccountController.php';
class Ewall_Customer_AccountController extends Mage_Customer_AccountController
{
public function createPostAjaxAction(){
         $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            //$this->_redirect('*/*/');
            //return;
            
            //$result["error"]=0;
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
          
        }
        $session->setEscapeMessages(true); // prevent XSS injection in user input
        if ($this->getRequest()->isPost()) {
            $errors = array();

            if (!$customer = Mage::registry('current_customer')) {
                $customer = Mage::getModel('customer/customer')->setId(null);
              
            }

            /* @var $customerForm Mage_Customer_Model_Form */
            $customerForm = Mage::getModel('customer/form');
            $customerForm->setFormCode('customer_account_create')
                ->setEntity($customer);

            $customerData = $customerForm->extractData($this->getRequest());
         
            if ($this->getRequest()->getParam('is_subscribed', false)) {
                $customer->setIsSubscribed(1);
            }

            /**
             * Initialize customer group id
             */
            $customer->getGroupId();

            if ($this->getRequest()->getPost('create_address')) {
                /* @var $address Mage_Customer_Model_Address */
                $address = Mage::getModel('customer/address');
                /* @var $addressForm Mage_Customer_Model_Form */
                $addressForm = Mage::getModel('customer/form');
                $addressForm->setFormCode('customer_register_address')
                    ->setEntity($address);

                $addressData    = $addressForm->extractData($this->getRequest(), 'address', false);
                $addressErrors  = $addressForm->validateData($addressData);
                if ($addressErrors === true) {
                    $address->setId(null)
                        ->setIsDefaultBilling($this->getRequest()->getParam('default_billing', false))
                        ->setIsDefaultShipping($this->getRequest()->getParam('default_shipping', false));
                    $addressForm->compactData($addressData);
                    $customer->addAddress($address);

                    $addressErrors = $address->validate();
                    if (is_array($addressErrors)) {
                        $errors = array_merge($errors, $addressErrors);
                    }
                } else {
                    $errors = array_merge($errors, $addressErrors);
                }
            }

            try {
                $customerErrors = $customerForm->validateData($customerData);
                if ($customerErrors !== true) {
                    $errors = array_merge($customerErrors, $errors);
                } else {
                    $customerForm->compactData($customerData);
                    $customer->setPassword($this->getRequest()->getPost('password'));
                    $customer->setConfirmation($this->getRequest()->getPost('confirmation'));
                    $customerErrors = $customer->validate();
                    if (is_array($customerErrors)) {
                        $errors = array_merge($customerErrors, $errors);
                    }
                }

                $validationResult = count($errors) == 0;

                if (true === $validationResult) {
                    $customer->save();

                    Mage::dispatchEvent('customer_register_success',
                        array('account_controller' => $this, 'customer' => $customer)
                    );

                    if ($customer->isConfirmationRequired()) {
                        $customer->sendNewAccountEmail(
                            'confirmation',
                            $session->getBeforeAuthUrl(),
                            Mage::app()->getStore()->getId()
                        );
                        //$session->addSuccess($this->__('Account confirmation is required. Please, check your email for the confirmation link. To resend the confirmation email please <a href="%s">click here</a>.', Mage::helper('customer')->getEmailConfirmationUrl($customer->getEmail())));
                        //$this->_redirectSuccess(Mage::getUrl('*/*/index', array('_secure'=>true)));
                         $result['url'] = Mage::getUrl('*/*/index', array('_secure'=>true));
                         $result['error'] = $this->__('Account confirmation is required. Please, check your email for the confirmation link. To resend the confirmation email please <a href="%s">click here</a>.', Mage::helper('customer')->getEmailConfirmationUrl($customer->getEmail()));
                        //return;
                    } else {
                        $session->setCustomerAsLoggedIn($customer);
                        //$url = $this->_welcomeCustomer($customer);
                        //$this->_redirectSuccess($url);
                        //$result['url'] = $this->_welcomeCustomer($customer);
                        //$result['url']= Mage::getUrl('customer/account');
                        $result['success'] = $this->__('You are successfully registered');
                       Mage::getSingleton('core/session')->getMessages(true);
                        //return;
                    }
                } else {
                    $session->setCustomerFormData($this->getRequest()->getPost());
                    if (is_array($errors)) {
                        foreach ($errors as $errorMessage) {
                            //$session->addError($errorMessage);
                            $result['error']= $errorMessage;
                           
                        }
                    } else {
                        //$session->addError($this->__('Invalid customer data'));
                        $result['error'] = $this->__('Invalid customer data');
                    }
                }
            } catch (Mage_Core_Exception $e) {
                $session->setCustomerFormData($this->getRequest()->getPost());
                if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                    $url = Mage::getUrl('customer/account/forgotpassword');
                    //$message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
                    $result['error'] = $this->__('There is already an account with this email address. If you are sure that it is your email address.');
                    $session->setEscapeMessages(false);
                } else {
                    //$message = $e->getMessage();
                    $result['error'] = $e->getMessage();
                }
                $session->addError($message);
            } catch (Exception $e) {
                //$session->setCustomerFormData($this->getRequest()->getPost())
                    //->addException($e, $this->__('Cannot save the customer.'));
                    $result['error'] = $this->__('Cannot save the customer.');
            }
        }
      	
         $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
	
        //$this->_redirectError(Mage::getUrl('*/*/create', array('_secure' => true)));
    }
	
    



}
