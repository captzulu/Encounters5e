<?php

function getModifier($abilityScore) {
    $mod = floor(($abilityScore - 10) / 2);
    $mod = $mod > 0 ? "+" . strval($mod) : strval($mod);
    return $mod;
}
