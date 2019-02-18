<?php
namespace Drupal\hello\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;
/**
* Provides a user details block.
*
* @Block(
*   id = "hello_block",
*   admin_label = @Translation("Hello!")
* )
*/
class HelloBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->_populate_markup(),
    );
  }

   private function _populate_markup(){
     $user = User::load(\Drupal::currentUser()->id());
     if($user->get('uid')->value<1){
     	return t('Welcome visitor! The current time is: ' . date('d-m-Y:i:s', time()));
       }else{
       	$user_information = 'User Name : ' . $user->getUsername(). "<br>";
       	$user_information = 'Language : ' . $user->getPreferredLangCode(). "<br>";
       	$user_information = 'Email : ' . $user->getUsername(). "<br>";
       	$user_information = 'Email : ' . $user->getEmail(). "<br>";
       	$user_information = 'Time Zone: ' . $user->getTimeZone(). "<br>";
       	$user_information = 'Created : ' . date('d-m-Y:i:s' , $user->getCreatedTime()). "<br>";
       	$user_information = 'Update : ' . date('d-m-Y:i:s' , $user->getCreatedTime()). "<br>";
       	$user_information = 'Last Login : ' . date('d-m-Y:i:s' , $user->getLastLoginTime()). "<br>";

       	$roles = NULL;

       	foreach ($user->getRoles() as $role) {
       		$roles .= $role . ",";
       	}

       	$roles = 'Roles: ' . rtrim($roles, ',');
       	$user_information .= $roles;
       	return $user_information;

       	
       }

   }

}