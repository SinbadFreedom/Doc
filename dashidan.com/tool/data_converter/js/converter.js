//
//  converter.js
//  Mr-Data-Converter
//
//  Created by Shan Carter on 2010-09-01.
//
function DataConverter() {
    this.outputDataType = "json";
    this.inputText = "";
    this.outputText = "";
    this.newLine = "\n";
    this.indent = "  ";
    this.headersProvided = true;
    this.downcaseHeaders = true;
    this.upcaseHeaders = false;
    this.includeWhiteSpace = true;
}

DataConverter.prototype.create = function () {
    var self = this;
    $("#dataOutput").click(function (evt) {
        this.select();
    });
    $("#insertSample").bind('click', function (evt) {
        evt.preventDefault();
        self.insertSampleData();
        self.convert();
        _gaq.push(['_trackEvent', 'SampleData', 'InsertGeneric']);
    });
    $("#dataInput").keyup(function () {
        self.convert()
    });
    $("#dataInput").change(function () {
        self.convert();
        _gaq.push(['_trackEvent', 'DataType', self.outputDataType]);
    });
    $("#dataSelector").bind('change', function (evt) {
        self.outputDataType = $(this).val();
        self.convert();
    });
};

DataConverter.prototype.convert = function () {
    this.inputText = $("#dataInput").val();
    this.outputText = "";
    //make sure there is input data before converting...
    if (this.inputText.length > 0) {
        
        if (this.includeWhiteSpace) {
            this.newLine = "\n";
        } else {
            this.indent = "";
            this.newLine = "";
        }
        CSVParser.resetLog();
        var parseOutput = CSVParser.parse(this.inputText, this.headersProvided, this.delimiter, this.downcaseHeaders, this.upcaseHeaders);
        var dataGrid = parseOutput.dataGrid;
        var headerNames = parseOutput.headerNames;
        var headerTypes = parseOutput.headerTypes;
        var errors = parseOutput.errors;
        this.outputText = DataGridRenderer[this.outputDataType](dataGrid, headerNames, headerTypes, this.indent, this.newLine);
        $("#dataOutput").val(errors + this.outputText);
    }
};

DataConverter.prototype.insertSampleData = function () {
    $("#dataInput").val("NAME\tVALUE\tCOLOR\tDATE\nAlan\t12\tblue\tSep. 25, 2009\nShan\t13\t\"green\tblue\"\tSep. 27, 2009\nJohn\t45\torange\tSep. 29, 2009\nMinna\t27\tteal\tSep. 30, 2009");
};


