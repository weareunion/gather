<?php
namespace Union\processor;

use Union\API\Respondus\RespondusException;

function run($data){
    throw new RespondusException("Standard Error", "Descrip[tion intenral", "Whoops!", "Nah");
}