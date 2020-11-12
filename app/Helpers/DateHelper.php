<?php

function monthName(int $index): string
{
    $names = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];

    return ($index > 0 && $index < 13) ? $names[$index - 1] : '';
}
