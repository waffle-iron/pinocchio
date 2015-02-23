 function userSubmit()
{
    var values = [];
    values["studentID"] = $("#studentnumber").val();
    values["Title"] = $("#title").val();
    values["Initials"] = $("#initials").val();
    values["Name"] = $("#firstname").val();
    values["Surname"] = $("#surname").val();
    values["Password"] = $("#password").val();
    values["Cell"] = $("#cell").val();
    values["Email"] = $("#email").val();
    values["Status"] = $("#status").val();
    
    var jsonValues = JSON.stringify(values);
    
    jQuery.ajax({
        type: "POST",
        url: "ajaxMiddleman.php",
        data: {table: "studentdetail", jsonValues: jsonValues, functionname: "userSubmit"},
        
        success: function(x)
        {
            alert(x + " SUCCESS");
        },
        error: function(x)
        {
            alert(x + " ERROR");
        }
    });
}

function roundSubmit()
{
    var values = [];

    values["roundID"] = $("#roundID").val();
    values["questionnaireID"] = $("#questionnaireID").val();
    values["startingDate"] = $("#startingDate").val();
    values["endingDate"] = $("#endingDate").val();
    values["roundDescription"] = $("#roundDescription").val();
    var jsonValues = JSON.stringify(values);
    
    jQuery.ajax({
        type: "POST",
        url: "ajaxMiddleman.php",
        data: {table: "rounddetail", jsonValues: jsonValues, functionname: "roundSubmit"},
        
        success: function(x)
        {
            alert(x + " SUCCESS");
        },
        error: function(x)
        {
            alert(x + " ERROR");
        }
    });
}

function teamSubmit()
{
    var values = [];

    values["teamDetailID"] = $("#teamDetailID").val();
    values["userID"] = $("#userID").val();
    values["roundID"] = $("#roundID").val();
    values["teamNumber"] = $("#teamNumber").val();
    values["status"] = $("#status").val();

    var jsonValues = JSON.stringify(values);

    document.write($("#teamDetailID").val());
    
    jQuery.ajax({
        type: "POST",
        url: "ajaxMiddleman.php",
        data: {table: "teamdetail", jsonValues: jsonValues, functionname: "teamSubmit"},
        
        success: function(x)
        {
            alert(x + " SUCCESS" + jsonValues);
        },
        error: function(x)
        {
            alert(x + " ERROR");
        }
    });
}

function csvSubmit()
{
    alert("Clicked CSV Submit");
}

function acceptEdit($stringRow)
{
    alert("Clicked Accept");
    jQuery.ajax({
        type: "POST",
        url: "ajaxMiddleman.php",
        data: {table: "studentdetail", jsonValues: jsonValues, functionname: "acceptEdit"},
        
        success: function(x)
        {
            alert(x + " SUCCESS");
        },
        error: function(x)
        {
            alert(x + " ERROR");
        }
    });
    /*<?php 
        $row = unserialize($stringRow);
        /// @TODO Update studentdetail as well
        updateTable("users", $row, $where = array("studentID" => $row["Student Number"]));
    ?>*/
}

function deleteRow($stringRow)
{
    alert("Clicked Delete");
    jQuery.ajax({
        type: "POST",
        url: "ajaxMiddleman.php",
        data: {table: "studentdetail", jsonValues: jsonValues, functionname: "deleteRow"},
        
        success: function(x)
        {
            alert(x + " SUCCESS");
        },
        error: function(x)
        {
            alert(x + " ERROR");
        }
    });
    /*<?php 
        $row = unserialize($stringRow);
        deleteFromTable("users", $row);
    ?>*/
}