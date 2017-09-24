/* * * * * * * * * *
 *   disTime .js   *
 *  Version 0.7.6  *
 *  License:  MIT  *
 * Simon  Waldherr *
 * * * * * * * * * */

/*jslint browser: true, indent: 2 */
/*globals languages, checkForAnd */
/*exported disTime */

var disTimeRepeater, disTimeObject, disTime;
disTimeObject = {
    parseTimestamp: function (language, thisTime, systemTime, detailed) {
        "use strict";
        var insert, distime, years, month, weeks, days, hours, minute, second;

        function pInt(string) {
            return parseInt(string, 10);
        }

        if (detailed === undefined) {
            detailed = false;
        }

        distime = (systemTime > thisTime) ? systemTime - thisTime : thisTime - systemTime;
        if (systemTime > thisTime) {
            insert = ' ' + language.words.preAgo + ' ';
        } else {
            insert = ' ' + language.words.inFuture + ' ';
        }

        if (distime > 31536000) {
            //years
            years = pInt(pInt(distime) / pInt(31536000));
            insert += years + ' ' + languages.declOfNum(language.mode, years, language.year);
        }

        if (((distime < 60 * 60 * 24 * 365) && (distime > 60 * 60 * 24 * 7 * 4))
            || ((distime > 60 * 60 * 24 * 365) && detailed && (pInt(distime % 31536000 / 2419200) !== 0))) {
            //months
            insert += checkForAnd(detailed, insert, language);
            month = pInt(distime % 31536000 / 2419200);
            insert += month + ' ' + languages.declOfNum(language.mode, month, language.month);

            if (((distime < 60 * 60 * 24 * 365) && detailed && (pInt(distime % 2419200 / 86400) !== 0))) {
                //days
                insert += checkForAnd(detailed, insert, language);
                days = pInt(distime % 2419200 / 86400);
                insert += days + ' ' + languages.declOfNum(language.mode, days, language.day);
            }
        }

        if (((distime < 60 * 60 * 24 * 7 * 4) && (distime > 60 * 60 * 24 * 7)) || ((distime < 10368000)
                                                                                   && (distime > 2419199) && detailed
                                                                                   && (pInt(distime % 2592000 / 2419200)
                                                                                       !== 0))) {
            //weeks
            insert += checkForAnd(detailed, insert, language);

            weeks = pInt(distime % 2419200 / 604800);
            insert += weeks + ' ' + languages.declOfNum(language.mode, weeks, language.week);
        }

        if (((distime < 60 * 60 * 24 * 7) && (distime > 86399)) || ((distime < 2419200) && (distime > 604799)
                                                                    && detailed && (pInt(distime % 604800 / 86400)
                                                                                    !== 0))) {
            //days
            insert += checkForAnd(detailed, insert, language);

            days = pInt(distime % 2419200 / 86400);
            insert += days + ' ' + languages.declOfNum(language.mode, days, language.day);
        }

        if (((distime < 86400) && (distime > 3599)) || ((distime < 604800) && (distime > 86399) && detailed
                                                        && (pInt(distime % 86400 / 3600) !== 0))) {
            //hours
            insert += checkForAnd(detailed, insert, language);

            hours = pInt(distime % 86400 / 3600);
            insert += hours + ' ' + languages.declOfNum(language.mode, hours, language.hour);
        }

        if (((distime < 3600) && (distime > 59)) || ((distime < 86400) && (distime > 3599) && detailed && (pInt(
                distime % 3600 / 60) !== 0))) {
            //minutes
            insert += checkForAnd(detailed, insert, language);

            minute = pInt(distime % 3600 / 60);
            insert += minute + ' ' + languages.declOfNum(language.mode, minute, language.minute);
        }

        if ((distime < 60) || ((distime < 3600) && (distime > 59) && detailed && (distime % 60 !== 0))) {
            //seconds
            insert += checkForAnd(detailed, insert, language);

            second = distime % 60;
            insert += second + ' ' + languages.declOfNum(language.mode, second, language.second);
        }

        if (systemTime > thisTime) {
            insert += ' ' + language.words.postAgo;
        }

        return insert;
    }
};

disTime = function (timedifference, language, detailed) {
    "use strict";
    var convertDate,
        convertTime,
        inputTime,
        timestamp,
        elementtime;

    if (detailed === undefined) {
        detailed = false;
    }
    if (language === undefined) {
        language = navigator.language || navigator.userLanguage;
    }
    if (languages[language] === undefined) {
        if (languages[language.split('-')[0]] !== undefined) {
            language = language.split('-')[0];
        } else {
            language = 'en';
        }
    }

    timestamp = parseInt(Date.now() / 1000, 10) + timedifference;
    convertDate = document.getElementById('convertDate');
    convertTime = document.getElementById('convertTime');
    inputTime = document.getElementById('inputTime');
    var inputTimeFloat = parseFloat(inputTime.value);
    if (inputTimeFloat > 2000000000) {
        inputTimeFloat = inputTimeFloat / 1000;
    }
    elementtime = parseInt(inputTimeFloat, 10);
    convertDate.innerHTML = formatDate(new Date(parseInt(elementtime) * 1000), "yyyy-MM-dd hh:mm:ss");
    convertTime.innerHTML = disTimeObject.parseTimestamp(languages[language], elementtime, timestamp, detailed);
};

formatDate = function (date, format) {
    var o = {
        "M+": date.getMonth() + 1, //month
        "d+": date.getDate(), //day
        "h+": date.getHours(), //hour
        "m+": date.getMinutes(), //minute
        "s+": date.getSeconds(), //second
        "q+": Math.floor((date.getMonth() + 3) / 3), //quarter
        "S": date.getMilliseconds()
        //millisecond
    };
    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (date.getFullYear() + "").substr(4 - RegExp.$1.length));
    }

    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
};
