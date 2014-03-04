var App = (function(lng, undefined) {

	sectionTrigger = function(event) {
           event.stopPropagation();
           setTimeout(function() {
                      lng.Notification.success("yout events manager", "info", 2);
                      }, 300);
		
	};

	articleTrigger = function(event) {
		event.stopPropagation();
		console.error(event);
	};

	return {
		sectionTrigger: sectionTrigger,
		articleTrigger: articleTrigger,
	};

})(Lungo);

App.config = {
	gender : null,
    skin_color:null,
    acne:null,
    freckle:null
};

Lungo.ready(function() {

});

Lungo.Events.init({
	'load section#gender1': App.sectionTrigger,
    
    'tap #gender_next_btn': function() {
        if(App.config.gender == null)
	        Lungo.Notification.success("please choose your gender.", "","", 2);
        else
			Lungo.Router.section("skin_section");
    },
    'tap #skin_next_btn': function() {
        if(App.config.skin_color == null)
	        Lungo.Notification.success("please choose your skin color.", "","", 2);
        else
			Lungo.Router.section("acne_section");
    },
    'tap #acne_next_btn': function() {
        if(App.config.acne == null)
	        Lungo.Notification.success("please choose one.", "","", 2);
        else
			Lungo.Router.section("freckle_section");
    },
    'tap #freckle_next_btn': function() {
        if(App.config.freckle == null)
	        Lungo.Notification.success("please choose one.", "","", 2);
        else
			Lungo.Router.section("products_section");
    },
    'tap .male_image': function() {
	    App.config.gender = "male";
    	App.component().gender_male().active();
    	App.component().gender_female().inactive();
    },
    'tap .female_image': function() {
	    App.config.gender = "female";
    	App.component().gender_male().inactive();
    	App.component().gender_female().active();
    },
    'tap .skin_color_1': function() {
	    App.config.skin_color = 1;
    	App.component().skin_color1().active();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_2': function() {
    	App.config.skin_color = 2;
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().active();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_3': function() {
	    App.config.skin_color = 3;
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().active();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_4': function() {
	    App.config.skin_color = 4;    
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().active();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_5': function() {
	    App.config.skin_color = 5;    
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().active();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_6': function() {
	    App.config.skin_color = 6;    
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().active();
    },
    'tap .acne_none': function() {
	    App.config.acne = "none";    
    	App.component().acne_none().active();
    	App.component().acne_few().inactive();
    	App.component().acne_many().inactive();
    },
    'tap .acne_few': function() {
	    App.config.acne = "few";      
    	App.component().acne_none().inactive();
    	App.component().acne_few().active();
    	App.component().acne_many().inactive();
    },
    'tap .acne_many': function() {
	    App.config.acne = "many";      
    	App.component().acne_none().inactive();
    	App.component().acne_few().inactive();
    	App.component().acne_many().active();
    },
    'tap .freckle_none': function() {
	    App.config.freckle = "none";      
    	App.component().freckle_none().active();
    	App.component().freckle_yes().inactive();
    },
    'tap .freckle_yes': function() {
	    App.config.freckle = "yes";      
    	App.component().freckle_none().inactive();
    	App.component().freckle_yes().active();
    },
});