<?php

if(!function_exists('isManager'))
{

    $numberFormatterDecimal = null;
    $numberFormatterInt = null;
    $markdownSlimdown = null;

    /**
     * Check if current user has Role 'manager'
     *
     * @return bool
     */
    function isManager()
    {
        return Auth::user()?->hasRole(['manager'], 'web') ?: false;
    }

    /**
     * Check if current user has Role 'worker'
     *
     * @return bool
     */
    function isWorker()
    {
        return Auth::user()?->hasRole(['worker'], 'web') ?: false;
    }

    /**
     * Check if current user has Role 'admin'
     *
     * @return bool
     */
    function isAdmin()
    {
        return Auth::user()?->hasRole(['admin'], 'web') ?: false;
    }

    /**
     * Check if current user has Role 'developer'
     *
     * @return bool
     */
    function isDeveloper()
    {
        return Auth::user()?->hasRole(['developer'], 'web') ?: false;
    }

    /**
     * Checks if user has role 'admin' or 'manager'
     *
     * @return bool
     */
    function isManagerAdmin()
    {
        return (isManager() || isAdmin());
    }

    /**
     * Checks Role > Permission using user()->hasPermissionTo
     * Requires: isCLI()
     * ! Always return TRUE if running in terminal!
     *
     * @param string $rolePermission
     * @return bool ! Always return TRUE if running in terminal!
     */
    function userCan(string $rolePermission)
    {
        return (isCLI() || \Auth::user()?->hasPermissionTo($rolePermission, 'web'));
    }

    /**
     * Check if user has role>permission, else throw exception.
     * ! Always passes check running in terminal because userCan() always returns TRUE if isCLI!
     * Requires: userCan()
     *
     * @param string $rolePermission
     * @return void
     * @throws Exception Throws Exception if the current user does not have the permission.
     */
    function securityCheckUserCan(string $rolePermission)
    {
        if(!userCan($rolePermission))
        {
            throw new \Exception('User does not have permission to: '.$rolePermission);
        }
    }

    /**
     * Number format to 2 decimal places
     * Uses Config: custom.decimal_separator, custom.thousands_separator
     */
    function nf(mixed $num, int $decimalPlaces = 0): string
    {
        if(is_int($num) || is_float($num) || is_numeric($num))
        {
            // Chris D. 3-Oct-2023 - it's converting it to words!!!???
            // global $numberFormatterDecimal;
            // if(is_null($numberFormatterDecimal)) {
            //     $numberFormatterDecimal = new NumberFormatter(App::currentLocale(), NumberFormatter::DECIMAL);
            // }
            // return $numberFormatterDecimal->format($num);
            return number_format($num, $decimalPlaces, config('custom.decimal_separator'), config('custom.thousands_separator'));
        }

        return strval($num);
    }

    /**
     * Number format to 0 decimal places
     * Uses Config: custom.decimal_separator, custom.thousands_separator
     */
    function nf0(mixed $num): string
    {
        // Chris D. 3-Oct-2023 - it's converting it to words!!!???
        // if(is_int($num) || is_float($num) || is_numeric($num)) {
        // global $numberFormatterInt;
        // if(is_null($numberFormatterInt)) {
        //     $numberFormatterInt = new NumberFormatter(App::currentLocale(), NumberFormatter::INTEGER_DIGITS);
        // }
        // $num = $numberFormatterInt->format($num);
        // }
        return nf($num, 0);
    }

    function cf0(mixed $num): string
    {
        return '$'.nf($num, 0);
    }

    /**
     * Remove ' and " from string.
     *
     * @param string $str
     * @return string
     */
    function removeQuotes(string $str)
    {
        return str_replace(['"', '\''], '', $str);
    }

    /**
     * Uses expression if(!$mixed)
     *
     * @param mixed        $mixed
     * @param mixed        $whatToReturnOnFalsy
     * @param mixed|string $elseReturnThis Default: ''
     * @return mixed|string
     */
    function falsy(mixed $mixed, mixed $whatToReturnOnFalsy, mixed $elseReturnThis = '')
    {
        if(!$mixed)
        {
            return $whatToReturnOnFalsy;
        }
        return $elseReturnThis;
    }

    /**
     * IF $mixed is "truthy"
     * THEN it will return $whatToReturnOnTruthy
     * ELSE it will return $elseReturnThis when "falsy"
     *
     * @param mixed        $mixed
     * @param mixed        $whatToReturnOnTruthy
     * @param mixed|string $elseReturnThis Default: ''
     * @return mixed|string
     */
    function truthy(mixed $mixed, mixed $whatToReturnOnTruthy, mixed $elseReturnThis = '')
    {
        if($mixed)
        {
            return $whatToReturnOnTruthy;
        }
        return $elseReturnThis;
    }

    /**
     * Get a value from the first row of the system_configs table using the SystemConfig class.
     *
     * @param string $fieldName
     * @return mixed
     */
    function systemConfig(string $fieldName)
    {
        return App\Models\SystemConfig::getFirstValue($fieldName);
    }

    /**
     * Replace \r\n and \n in string with <br/>
     *
     * @param string $str
     * @param string $br
     * @return string
     */
    function rnl2br(string $str, string $br = '<br/>'): string
    {
        $str = str_replace("\r\n", $br, $str);
        return str_replace("\n", $br, $str);
    }

    /**
     * Wrap a string in html tags and insert any supplied attributes.
     *
     * @param string $tag        The html tag to use. Example: 'a', 'div', 'span', 'p', etc.
     * @param string $slot       The innerHTML of the tag
     * @param array  $attributes Example input: htmlTag('a','My Link', ['href' => '#'])
     * @return string            Example output: '<a href="#">My Link</a>'
     */
    function htmlTag(string $tag, string $slot, array $attributes = []): string
    {
        return sprintf('<%s %s>%s</%s>', $tag, htmlElementAttributes($attributes), $slot, $tag);
    }

    /**
     * Generate html element attributes to insert into a tag.
     *
     * @param array $attributes Input Example: ['class' => 'btn btn-primary', 'id' => 'btn1']
     * @return string Output Example: 'class="btn btn-primary" id="btn1"'
     */
    function htmlElementAttributes(array $attributes = []): string
    {
        $attr = '';
        foreach($attributes as $attribute => $value)
        {
            if($value === '')
            {
                $attr .= $attribute.' ';
            }
            else
            {
                $attr .= $attribute.'="'.$value.'" ';
            }
        }
        return trim($attr);
    }

    function isProduction()
    {
        return App::environment('production');
    }

    function isStaging()
    {
        return App::environment('staging');
    }

    function isLocal()
    {
        return App::environment('local');
    }

    function isCLI()
    {
        return app()->runningInConsole();
    }

    /**
     * Return set string when $str !== ''
     *
     * @param string $str This string will be passed through trim() method.
     * @param string $returnWhenNotEmpty
     * @param string $returnOtherwise
     * @return string
     */
    function whenStringNotEmpty(string $str, string $returnWhenNotEmpty, string $returnOtherwise = ''): string
    {
        return (trim($str) !== '' ? $returnWhenNotEmpty : $returnOtherwise);
    }

    /**
     * Return set string when $str === ''
     *
     * @param string $str This string will be passed through trim() method.
     * @param string $returnWhenEmpty
     * @param string $returnOtherwise
     * @return string
     */
    function whenStringEmpty(string $str, string $returnWhenEmpty, string $returnOtherwise = ''): string
    {
        return (trim($str) === '' ? $returnWhenEmpty : $returnOtherwise);
    }

    function logDebug(mixed $m)
    {
        if(!is_string($m))
        {
            \Log::debug(json_encode($m));
        }
        else
        {
            \Log::debug($m);
        }
    }

    /**
     * Much faster than using Carbon!!!
     *
     * @param string|null $mysqlDateTimeString Mysql Date or Mysql Date Time string
     * @param string      $format              Format passed to PHP date() function
     * @return string
     */
    function myDateFormat(?string $mysqlDateTimeString, string $format): string
    {
        if(is_null($mysqlDateTimeString) || $mysqlDateTimeString === '')
        {
            return '';
        }

        // 2023-09-21 20:30:33.999999
        // 2023-09-21 20:30:33
        // 2023-09-21
        if(strlen($mysqlDateTimeString) === 26
           || strlen($mysqlDateTimeString) === 19
           || strlen($mysqlDateTimeString) === 10
        )
        {
            // -
            return date($format, strtotime($mysqlDateTimeString));
        }
        // else
        // Only throw exception in development local/staging
        if(!isProduction())
        {
            throw new \Exception('Unsupported mysql date time format: '.$mysqlDateTimeString);
        }
        // In Production environment, fall back to displaying the received string
        return $mysqlDateTimeString;
    }

    function markdown(string $s): string
    {
        global $markdownSlimdown;
        if(is_null($markdownSlimdown))
        {
            $markdownSlimdown = new \App\Libraries\MarkdownSlimdown();
        }
        return $markdownSlimdown->parse($s);
    }

    function nbsp(string $s): string
    {
        return \str_replace(' ', '&nbsp;', $s);
    }
}

if(!function_exists('messageInfo'))
{
    function messageInfo(string $message, string $actionLabel = '', string $actionUrl = ''): void
    {
        if($actionLabel !== '')
        {
            $message .= \PHP_EOL.\messageCTA($actionLabel, $actionUrl);
        }
        \App\Libraries\SessionAlert::info($message);
    }
}

if(!function_exists('messageWarning'))
{
    function messageWarning(string $message, string $actionLabel = '', string $actionUrl = ''): void
    {
        if($actionLabel !== '')
        {
            $message .= \PHP_EOL.\messageCTA($actionLabel, $actionUrl);
        }
        \App\Libraries\SessionAlert::warning($message);
    }
}

if(!function_exists('messageSuccess'))
{
    function messageSuccess(string $message, string $actionLabel = '', string $actionUrl = ''): void
    {
        if($actionLabel !== '')
        {
            $message .= \PHP_EOL.\messageCTA($actionLabel, $actionUrl);
        }
        \App\Libraries\SessionAlert::success($message);
    }
}

if(!function_exists('messageError'))
{

    function messageError(string $message, string $actionLabel = '', string $actionUrl = ''): void
    {
        if($actionLabel !== '')
        {
            $message .= \PHP_EOL.\messageCTA($actionLabel, $actionUrl);
        }
        \App\Libraries\SessionAlert::error($message);
    }
}

if(!function_exists('__t'))
{

    /**
     * Translate all values of an array.
     * ! Caution: Will skip any values that are not type: string
     *
     * @param array $arr
     * @return array Translated array
     * @throws Exception IF not Production Environment throw Exception, otherwise Log Error --
     *                   When any of the values in the array are not strings and not numeric.
     */
    function __tArr(array $arr): array
    {
        foreach($arr as $i => $t)
        {
            if(!is_string($t) && !is_numeric($t))
            {
                // Only throw exception in development local/staging
                if(!isProduction())
                {
                    throw new \Exception('Param $t is not a string; Got type: '.gettype($t));
                }
                Log::error('Error in '.__FUNCTION__.'() param is not a string; Got type: '.gettype($t), debug_backtrace());
                $t = '#'.gettype($t).'#';
            }
            $arr[$i] = __($t);
        }
        return $arr;
    }

    /**
     * Translate all params and return them concatenated by a space.
     *
     * @param ...$params
     * @return string
     * @throws Exception If any of the $params is not a string type
     */
    function __t(...$params): string
    {
        $arr = __tArr($params);
        return implode(' ', $arr);
    }

    /**
     * Translate all words within the string, one at a time.
     * Explode string based on separator (default: space).
     *
     * @param string $words
     * @param string $separator
     * @return string
     */
    function __tw(string $words, string $separator = ' '): string
    {
        $arr = explode($separator, $words);
        $translatedWords = [];
        foreach($arr as $word)
        {
            $translatedWords[] = __($word);
        }
        return implode($separator, $translatedWords);
    }

    /**
     * Translate all words within the string, one at a time.
     * Explode string based on separator (default: space).
     * Example 1 Input: 'Client,Vehicle,Date'
     *           Output: 'Cliente,Vehículo,Fecha'
     *
     * Example 2 Input: 'Client, Vehicle, Date'
     *           $separator = ', '
     *           Output: 'Cliente, Vehículo, Fecha'
     *
     * @param string $csv
     * @param string $separator
     * @return string $implodeString IF null, will use $separator to implode the array.
     * @throws Exception
     */
    function __tCsv(string $csv, string $separator = ',', ?string $implodeString = null): string
    {
        $arr = explode($separator, $csv);
        return implode(($implodeString ?? $separator), __tArr($arr));
    }

    /**
     * Translate all params and use sprintf( {1st param}, {...other params} )
     *
     * @param string $template
     * @param string ...$params Should be all strings, otherwise vsprintf() may throw Exception. First param is used as the format string
     * @return string return vsprintf($format, $arr);
     * @throws Exception See __tArr()
     */
    function __tSprintf(...$params): string
    {
        $arr = __tArr($params);
        // Use first param as format string
        $format = array_shift($arr);
        // https://www.php.net/manual/en/function.vsprintf.php
        // Operates as sprintf() but accepts an array of arguments, rather than a variable number of arguments.
        return vsprintf($format, $arr);
    }
}

if(!function_exists('messageCTA'))
{
    function messageCTA(string $actionLabel = '', string $actionUrl = ''): string
    {
        return '<a class="message-cta" href="'.$actionUrl.'">'.$actionLabel.'</a>';
    }
}

if(!function_exists('trimTextBlock'))
{
    /**
     * Trim space and new line characters from the text.
     * Replace \r\n with \n
     *
     * @param string $textBlock E.g. The text the user types into a textarea element.
     * @return string
     */
    function trimTextBlock(string $textBlock): string
    {
        $textBlock = \str_replace("\r\n", "\n", $textBlock);
        return trim($textBlock, " \n\r\t\v\0");
    }
}

if(!function_exists('csv'))
{
    /**
     * Helper function for implode() with separator: ',' (comma)
     *
     * @param array  $arr
     * @param string $separator Default: ','
     * @return string
     */
    function csv(array $arr, string $separator = ','): string
    {
        return implode($separator, $arr);
    }
}

if(!function_exists('unCsv'))
{
    /**
     * Helper function for implode() with separator: ',' (comma)
     *
     * @param string $csv
     * @param string $separator Default: ','
     * @return array
     */
    function unCsv(string $csv, string $separator = ','): array
    {
        return explode($separator, $csv);
    }
}

if(!function_exists('br'))
{
    /**
     * Helper function for implode() with separator: '<br>'.PHP_EOL
     *
     * @param array  $arr
     * @param string $separator Default: '<br>'.PHP_EOL
     * @return string
     */
    function br(array $arr, string $separator = '<br>'.PHP_EOL): string
    {
        return implode($separator, $arr);
    }
}

if(!function_exists('formatCarbonLocalized'))
{
    /**
     * Format Carbon date in the current locale with code: locale(config('app.locale'))->translatedFormat($format);
     *
     * @param \Carbon\Carbon $carbon
     * @param string         $format
     * @return string
     */
    function formatCarbonLocalized(\Carbon\Carbon &$carbon, string $format): string
    {
        return $carbon->locale(config('app.locale'))->translatedFormat($format);
    }
}

if(!function_exists('dateLocalized'))
{
    /**
     * See DateLib::dateLocalized()
     *
     * @param null|string|\Carbon\Carbon $carbonOrString           String must be a format that Carbon can parse.
     * @param int|string                 $format                   IF int uses a preset format. See DateLib::dateLocalized().
     *                                                             IF string will be used as the format.
     * @param string                     $separator                Default: ' '
     * @return string Returns '' when $carbonOrString is null.
     * @throws Exception
     */
    function dateLocalized(null|string|\Carbon\Carbon $carbonOrString, int|string $format = 1, string $separator = ' '): string
    {
        if(is_null($carbonOrString))
        {
            return '';
        }

        return \App\Libraries\DateLib::dateLocalized($carbonOrString, $format, $separator);
    }
}

if(!function_exists('currency'))
{
    function currency(mixed $value): string
    {
        return \App\Libraries\PresentLib::currency($value);
    }
}

if(!function_exists('currencyExt'))
{
    /**
     * Helper function for PresentLib::currencyExt()
     *
     * @param mixed $value
     * @return string
     */
    function currencyExt(mixed $value): string
    {
        return \App\Libraries\PresentLib::currencyExt($value);
    }
}

if(!function_exists('currencySymbol'))
{
    /**
     * Helper function for PresentLib::currencySymbol()
     *
     * @param bool $extended Display currency with extended symbol. e.g. UY$ 1.000,00 (instead of: $ 1.000,00)
     * @return string
     */
    function currencySymbol(bool $extended): string
    {
        return \App\Libraries\PresentLib::currencySymbol($extended);
    }
}

if(!function_exists('vd'))
{

    /**
     * var_dump($var) and exit
     */
    function vd(mixed $var, bool $exit = true): void
    {
        echo '<pre>';
        $backtrace = debug_backtrace();
        // Explain where this function was called from:
        echo $backtrace[0]['file'].':'.$backtrace[0]['line']."\n";
        // Dump
        var_dump($var);
        // Exit?
        if($exit)
        {
            exit();
        }
    }
}

if(!function_exists('echoCLI'))
{
    /**
     * Echo output text with colour.
     * ! ONLY if running in terminal!
     * Requires: isCLI()
     *
     * @param string $text
     * @param int    $colorCode       (31=Red), (32=Green), (33=Yellow), (34=Blue), (35=Magenta), (36=Cyan)
     * @param bool   $addNewLineAfter Add new line after text? PHP_EOL
     * @return void
     * @uses echoWithColor('This is cyan text', '36');
     */
    function echoCLI(string $text, int $colorCode = 32, bool $addNewLineAfter = true)
    {
        if(isCLI())
        {
            echo "\033[".$colorCode."m".$text."\033[0m".($addNewLineAfter ? PHP_EOL : '');
        }
    }
}

if(!function_exists('isCLI'))
{
    /**
     * @return bool True if running in terminal
     */
    function isCLI()
    {
        return (php_sapi_name() === 'cli' || str_starts_with(php_sapi_name(), 'cli-'));
    }
}

if(!function_exists('currency'))
{
    /**
     * Short cut helper for PresentLib::currency()
     *
     * @return string Response from PresentLib::currency()
     */
    function currency(mixed $value, bool $extendedSymbol = false): string
    {
        return \App\Libraries\PresentLib::currency($value, $extendedSymbol);
    }
}

if(!function_exists('logLocal'))
{
    /**
     * Logs a debug message if environment is local.
     * Requires: Laravel Log class & debug method \Log::debug
     * Requires: helper function isLocal()
     *
     * @param mixed $m Will be converted to a string.
     * @param array $context
     * @return void
     */
    function logLocal(mixed $m, array $context = [])
    {
        if(isLocal())
        {
            if(!is_string($m))
            {
                if(gettype($m) == 'object' && method_exists($m, '__toString'))
                {
                    $m = $m->__toString();
                }
                else
                {
                    $m = json_encode($m, \JSON_PRETTY_PRINT);
                }
            }
            \Log::channel('local')->debug($m, $context);
        }
    }
}

if(!function_exists('usesTrait'))
{
    function usesTrait(string $classToCheckIn, string $traitName): bool
    {
        // https://laravel.com/docs/11.x/helpers#method-class-uses-recursive
        return in_array($traitName, class_uses_recursive($classToCheckIn));
    }
}

if(!function_exists('checkNotEmpty'))
{
    function checkNotEmpty(mixed $var, bool $throwException = true, string $varNameInfo = ''): void
    {
        if(empty($var) && $throwException)
        {
            throw new \Exception('required var can\'t be empty: '.$varNameInfo);
        }
    }
}

if(!function_exists('isClosure'))
{
    function isClosure(mixed &$x)
    {
        return $x instanceof \Closure;
    }
}

if(!function_exists('rif'))
{

    /**
     * "RIF" = "RETURN IF"
     * Return a value IF expression is truthy;
     *
     * @param mixed $x       Expression
     * @param mixed $ifTrue  Value to return if expression is true
     * @param mixed $ifFalse Value to return if expression is false
     *
     * @return bool
     */
    function rif(mixed $x, mixed $ifTrue, mixed $ifFalse = ''): mixed
    {
        return ($x ? $ifTrue : $ifFalse);
    }
}

if(!function_exists('intRound'))
{
    /**
     * @return int Return intval(round($val,0))
     */
    function intRound(mixed $val): int
    {
        return intval(round($val, 0));
    }
}

if(!function_exists('yesNo'))
{
    /**
     * @return string 'Yes', or 'No' when $val is empty()
     */
    function yesNo(mixed $val): string
    {
        return (empty($val) ? 'No' : 'Yes');
    }
}

if(!function_exists('isAppUrl'))
{
    /**
     * Check if a URL is for this app (Internal), or else it's an External link.
     *
     * @param string|null $url
     * @return bool Return true when the string is not empty and starts with APP_URL
     */
    function isAppUrl(?string $url): bool
    {
        return (!is_null($url)
                && (
                    str_starts_with($url, config('app.url')) || str_starts_with($url, '/')
                )
        );
    }
}

if(!function_exists('digitsOnly'))
{
    /**
     * Helper function to remove all non-digit characters from a string using StringLib::digitsOnly()
     *
     * @param mixed $str
     * @return string
     */
    function digitsOnly(mixed $str): string
    {
        return \App\Libraries\StringLib::digitsOnly($str);
    }
}
