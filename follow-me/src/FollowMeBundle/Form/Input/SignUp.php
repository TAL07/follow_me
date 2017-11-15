<?php

namespace FollowMeBundle\Form\Input;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;



class SignUp extends SignIn
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        parent::buildForm($builder, $options);
        $builder
        ->add("confirm", TextType::class, [
            "label" => "Confirmation", 
            "constraints" => [
                new Regex([
                    "pattern" => "/^[\w]{8,32}$/",
                    "message" => "sign.pswd.car.error"
                ]),
                new NotBlank([
                    "message" => "sign.confirm.error"
                ])
            ],
            "attr" => [
                "class" => "form-control",
                ]
            ]);

           

                
    }





}

