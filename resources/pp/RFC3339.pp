%token year                                    \d\d\d\d
%token month                                   01|02|03|04|05|06|07|08|09|10|11|12                                                            -> day
%token day:day                                 01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31   -> default

%token date_separator                          -
%token day:date_separator                      -

%token hour                                    \d{2}                                                                                          -> minute
%token minute:minute                           \d{2}                                                                                          -> second
%token second:second                           \d{2}                                                                                          -> timezone

%token time_seperator                           :
%token minute:time_seperator                    :
%token second:time_seperator                    :

%token time_from_date_separator                 T

%token timezone:microseconds_separator          \.                                                                                            -> microsecond
%token microsecond:microsecond                  \d+                                                                                           -> timezone

%token timezone:timezone_positive               \+
%token timezone:timezone_negative               -
%token timezone:timezone_utc                    Z

%token timezone:timezone_value                  \d{4}                                                                                         -> default
%token timezone:_timezone                       \d{2}                                                                                         -> timezone_seperated
%token timezone_seperated:timezone_             \d{2}                                                                                         -> default

%token timezone_seperated:timezone_separator    :

#datestring:
    <year> ::date_separator:: <month> ::date_separator:: <day> ::time_from_date_separator:: time() ( microseconds() )? ( timezone() )?

time:
    <hour> ::time_seperator:: <minute> ::time_seperator:: <second>

microseconds:
    ::microseconds_separator:: <microsecond>

timezone:
    <timezone_utc> | ( ( <timezone_positive> | <timezone_negative> ) timezone_string() )

timezone_string:
    (<timezone_value> | <_timezone> ::timezone_separator:: <timezone_>)
