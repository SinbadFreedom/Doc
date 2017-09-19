$(document).ready(function () {
    var d = new DataConverter();
    d.create();
    d.includeWhiteSpace = true;
    d.indent = " ";
    d.headersProvided = true;
    d.downcaseHeaders = false;
    d.upcaseHeaders = false;
    d.delimiter = 'auto';
    d.decimal = 'dot';
    d.useUnderscores = true;
    d.convert();
});