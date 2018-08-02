<?php

function getModifier($abilityScore) {
    return floor(($abilityScore - 10) / 2);
}
