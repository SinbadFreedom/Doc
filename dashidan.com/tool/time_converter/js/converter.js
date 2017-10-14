/**
 * Created by bj on 2015/9/10.
 */
/*global disTime, disTimeRepeater */
/*jslint browser: true, indent: 2 */
function random(min, max) {
    "use strict";
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function generateExamples(config) {
    "use strict";
    var time            = new Date(),
        examplesElement = document.getElementById('examples'),
        examples        = '',
        timestamp;

    timestamp = parseInt(time.getTime() / 1000 - i * (100 + random(0, 42)), 10);
    examples += '<p class="distime" data-time="' + timestamp + '">' + timestamp + '</p>';
    examplesElement.innerHTML +=
        '<p class="distime" data-time="' + parseInt(time.getTime() / 1000 - parseInt(eval(config.time), 10), 10) + '">'
        + parseInt(time.getTime()
                   / 1000
                   - parseInt(eval(config.time),
                              10),
                   10) + '</p>'
        + examples;
}

function init() {
    "use strict";
    var config,
        hash,
        i,
        userLang = navigator.language || navigator.userLanguage;

    config = {'lang': userLang, 'time': '60*60*24', 'detail': 1};
    hash = window.location.hash.replace('#', '').split('&');
    for (i = 0; i < hash.length; i += 1) {
        config[hash[i].split('=')[0]] = hash[i].split('=')[1];
    }
    generateExamples(config);
    disTime(0, config.lang, parseInt(config.detail, 10));
}

function changeDemo() {
    "use strict";
    var lang,
        detail;
    lang = document.getElementById('lang').value;
    detail = document.getElementById('detail').value === 'on' ? true : false;
    window.clearTimeout(disTimeRepeater);
    disTime(0, lang, detail);
}

function convertDateToTimeStamp() {
    var dateStr = document.getElementById('inputDate').value;
    var timeStamp = new Date(dateStr).valueOf();
    document.getElementById('convertTimeStamp').innerHTML = timeStamp;
}
