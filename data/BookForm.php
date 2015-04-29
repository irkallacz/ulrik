<?php
use Nette\Forms\Form;

class BookForm extends Nette\Forms\Form
{
    public function __construct()
    {
       parent::__construct();
       $form->addText('name','Jméno')->setRequired('Jméno je povinné');
       $form->addText('mail','Email')->setType('email');
       $form->addTextArea('text');
       $form->addSubmit('ok','Odeslat');
       $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
    }
}