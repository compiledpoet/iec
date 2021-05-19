
 

$( document ).ready(function() {


    document.getElementById("btn-reg-district").onclick  =()=>{
        const elementName = $("#inp-name");
        const elementCode = $("#inp-code");

        elementName.removeClass("input-error");
        elementCode.removeClass("input-error");
        $("#s-error-district").addClass("hidden");      
        
        const name = elementName.val();
        const code = elementCode.val();

        const errors = [];
        if(!name || name == ""){
            errors.push("Name");
            elementName.addClass("input-error");
        }
        if(!code || code == ""){
            errors.push("Code");
            elementCode.addClass("input-error");
        }

        if(errors.length == 0){
            const body = { name, code};
            console.log("reg", body);

        }else{
            $("#s-error-district").removeClass("hidden").html("Invalid: " + errors.join(", "));
        }
         return false;
    }
});

