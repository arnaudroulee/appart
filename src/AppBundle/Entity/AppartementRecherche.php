<?php
namespace AppBundle\Entity;

class AppartementRecherche
{
    public $nom;

    public function __construct(array $data) {
        foreach($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function toArray()
    {
        return array(
            'nom' => $this->nom,
        );
    }
}