var App = (function(lng, undefined) {

	return {

	};

})(Lungo);

App.question_data = {
	gender : "A",
    skin_color:"0",
    acne:"c",
    freckle:"d"
};

Lungo.ready(function() {

	// Initialize DB.
	App.database.open();
    // Create instance of user for the current user. 

	App.current_user = new App.user();

	// Check if there is a logged in user.
	App.current_user.getLoggedInUser();
});

Lungo.Events.init({
    'load section#doctors_list_section':function () {
    	App.map.addMap("doctors_map_canvas");
    },
    'load section#events_list_section':function () {
    	App.map.addMap("events_map_canvas");
    },
    'load section#gender':function () {
    	if(App.current_user.details.gender == "Male")
    	{	
    		App.question_data.gender = "m";
    		App.component().gender_male().active();
    		App.component().gender_female().inactive();
    	}
    	else
    	{
    		App.question_data.gender = "f";
    		App.component().gender_male().inactive();
    		App.component().gender_female().active();
    	}
    },
    
    'tap #event_search_clear': function() {
        Lungo.dom("#s_event_time").val('');
        Lungo.dom("#s_event_area_select").val('1');
    },
    
    'tap #doctor_search_clear': function() {
        Lungo.dom("#s_doctor_name").val('');
        Lungo.dom("#s_clinic_name").val('1');
        Lungo.dom("#s_doctor_area_search").val('1');
    },
    
    'tap #login_btn': function() {
	   //App.current_user.logout();
        App.current_user.addUser();
    },
    
    'tap #gender_next_btn': function() {
	    Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_0.png");
		Lungo.Router.section("skin_section");
    },
    'tap #skin_next_btn': function() {
        if(App.question_data.skin_color == 0)
	        Lungo.Notification.success("please choose your skin color.", "","", 2);
        else{
        	Lungo.dom(".acne_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
        	Lungo.dom(".freckle_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
			Lungo.Router.section("acne_section");
		}
    },
    'tap #acne_next_btn': function() {
        if(App.question_data.acne == null)
	        Lungo.Notification.success("please choose one.", "","", 2);
        else{        	
			Lungo.Router.section("freckle_section");
		}
    },
    'tap #freckle_next_btn': function() {
        if(App.question_data.freckle == null)
	        Lungo.Notification.success("please choose one.", "","", 2);
        else
			Lungo.Router.section("results_section");
    },
});
