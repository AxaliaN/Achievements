$(document).ready(function(){
    $.each(achievementsUnlocked, function(e, item){
        $('.achievements-awarded').notify({
            message: { text: 'Achievement "' + item + '" unlocked!'},
            type: 'blackgloss',
            transition: 'fade',
            fadeOut: {
                enabled: true,
                delay: 3000
            }
        }).show();
    });


    $.each(achievementsRemoved, function(e, item){
        $('.achievements-removed').notify({
            message: { text: 'Achievement "' + item + '" lost!'},
            type: 'danger',
            transition: 'fade',
            fadeOut: {
                enabled: true,
                delay: 3000
            }
        }).show();
    });
});