<?php

function capitalizeEachWord(string $fullName): string
{
    return ucwords(strtolower(trim($fullName)));
}
