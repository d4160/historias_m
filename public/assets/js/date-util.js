Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

function GetDate(dateTime, daysToAdd = 0) {
    let newDate = dateTime.addDays(daysToAdd);
    return `${newDate.getFullYear()}-${(newDate.getMonth()+1).toString().padStart(2, '0')}-${newDate.getDate().toString().padStart(2, '0')}`;
}

function GetTodayDate(daysToAdd = 0) {
    let newDate = new Date().addDays(daysToAdd);
    return GetDate(newDate);
}

function CalculateAge(dateSelectQ, yearSelectQ){
    $(dateSelectQ).change(() => {
        let fecNac = new Date($(dateSelectQ).val());
        let today = new Date();
        let years = today.getFullYear() - fecNac.getFullYear();
        let months =  today.getMonth() - fecNac.getMonth();
        let days = today.getDate() - (fecNac.getDate() + 1);

        if (months < 0) {
            years--;
        }
        else if (months === 0) {
            if (days < 0) {
                years--;
            }
        }

        $(yearSelectQ).val(years);
    });
}