/**
 * Created by danfinkelstein on 4/12/2015.
 */

var emails;

function check_emails() {
    var num_occur = 0, same_domain = 1;
    for (var i = 0; i < emails.length; i++){
        for (var j = emails.length; j > 0; j--){
            if (emails[i] != undefined && emails[j] != undefined) {
                if (emails[i].val() != "" && emails[j].val() != "" &&
                    emails[i].val() != undefined && emails[j].val() != undefined) {
                    var e1 = emails[i].val(), e2 = emails[j].val();
                    if (e1 == e2) {
                        num_occur++;
                    } else if (e1.substring(e1.indexOf('@')) != e2.substring(e2.indexOf('@'))){
                        same_domain = 0;
                    }
                }
            }
        }
    }


    if (num_occur > 4) {
        alert("Emails cannot be the same!");
        event.preventDefault();
    }

    if (same_domain == 0) {
        alert("Emails must be in the same domain!");
        event.preventDefault();
    }
}

$(document).ready(function() {
    var email1 = $("#admin");
    var email2 = $('#mem1');
    var email3 = $('#mem2');
    var email4 = $('#mem3');
    var email5 = $('#mem4');
    emails = [email1, email2, email3, email4, email5];

    $('#submit-button').click( function() {
        console.log("Change occurred");
        check_emails();
    });
} );