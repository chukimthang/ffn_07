var app = function () {
    this.init = function() {
        this.addEvent();
    }

    this.addEvent = function() {
        $('.input-group.date.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm:ss'
        });
    }
}
