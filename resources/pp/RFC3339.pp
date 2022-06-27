%token T_YEAR                                  \d\d\d\d                                                                                       -> month
%token month:T_MONTH                           01|02|03|04|05|06|07|08|09|10|11|12                                                            -> day
%token day:T_DAY                               01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31   -> sep

%token month:T_DATE_SEPARATOR                  -
%token day:T_DATE_SEPARATOR                    -

%token sep:T_TIME_FROM_DATE_SEPARATOR          T                                                                                              -> hour

%token hour:T_HOUR                             \d{2}                                                                                          -> minute
%token minute:T_MINUTE                         \d{2}                                                                                          -> second
%token second:T_SECOND                         \d{2}                                                                                          -> timezone

%token T_TIME_SEPARATOR                         :
%token minute:T_TIME_SEPARATOR                  :
%token second:T_TIME_SEPARATOR                  :

%token timezone:T_MICROSECONDS_SEPARATOR        \.                                                                                            -> microsecond
%token microsecond:T_MICROSECOND                \d+                                                                                           -> timezone

%token timezone:T_TIMEZONE_POSITIVE             \+
%token timezone:T_TIMEZONE_NEGATIVE             -
%token timezone:T_TIMEZONE_UTC                  Z

%token timezone:T_TIMEZONE_VALUE                \d{4}                                                                                         -> default
%token timezone:T_TIMEZONE_LEFT                 \d{2}                                                                                         -> timezone_seperated
%token timezone_seperated:T_TIMEZONE_RIGHT      \d{2}                                                                                         -> default

%token timezone_seperated:T_TIMEZONE_SEPARATOR  :

#datestring
    : date() ::T_TIME_FROM_DATE_SEPARATOR:: time() ( microseconds() )? ( timezone() )?
    ;

date
    : <T_YEAR> ::T_DATE_SEPARATOR:: <T_MONTH> ::T_DATE_SEPARATOR:: <T_DAY>
    ;

time
    : <T_HOUR> ::T_TIME_SEPARATOR:: <T_MINUTE> ::T_TIME_SEPARATOR:: <T_SECOND>
    ;

microseconds
    : ::T_MICROSECONDS_SEPARATOR:: <T_MICROSECOND>
    ;

timezone
    : <T_TIMEZONE_UTC> | ( ( <T_TIMEZONE_POSITIVE> | <T_TIMEZONE_NEGATIVE> ) timezone_string() )
    ;

timezone_string
    : (<T_TIMEZONE_VALUE> | <T_TIMEZONE_LEFT> ::T_TIMEZONE_SEPARATOR:: <T_TIMEZONE_RIGHT>)
    ;
