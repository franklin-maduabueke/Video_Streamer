<?php
    function generateID($markerLength, $alnum = TRUE, $ucase = FALSE, $prefix = '', $suffix = '', $numOnly = FALSE)
    {
        if ($markerLength == 0)
            return '';
    
        $sequence = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $sb = '';
        if ( ! $numOnly)
        {
            if ( ! $alnum)
                $sequence = substr($sequence, 0, strlen($sequence) - 10);
    
            if ($ucase)
                $sequence = strtoupper($sequence);
        }
        else
            $sequence = substr($sequence, stripos($sequence, '0'));
    
        $rangeLength = strlen($sequence);

        for ($count = 0; $count < ($markerLength - (strlen($prefix) + strlen($suffix))); $count++)
        {
            $randNum = rand(0, (int)$rangeLength - 1);
            $sb .= substr($sequence, $randNum, 1);
        }
    
        return $prefix . $sb . $suffix;
    }

    //call to minify the number with proper subscript for hundered, thousand, million, billion e.t.c
    function    numberMinify($number, $limitSeparator = -1)
    {
        $minifiedNumber = number_format($number . '');
        if ($limitSeparator > -1)
        {
            $numberSubscript = array('K', 'M', 'B', 'T');
            $countComma = substr_count($minifiedNumber, ',');
            if ($countComma > $limitSeparator)
            {
                if ($countComma < count($numberSubscript))
                {
                    $subscript = $numberSubscript[$countComma - 1];
                    for ($i = $countComma; i > $limitSeparator; --$i)
                        $minifiedNumber = substr($minifiedNumber, 0, strrpos($minifiedNumber, ','));

                    $minifiedNumber .= $subscript;
                }
            }
        }

        return $minifiedNumber;
    }

    function    isUserSessionValid()
    {
        return isset($_SESSION['user_session_key']);
    }