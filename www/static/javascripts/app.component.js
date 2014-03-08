App.component = function() {
	return {
		gender_male : function () {
        	return {
                active : function () { 
                	//age = App.current_user.details.age;
                	Lungo.dom(".male_original_image").attr("src", "img/face/"+App.current_user.details.age+"/m_"+App.current_user.details.age+"_0.png");
                	Lungo.dom(".male_red_check_image").show();
                },
                inactive : function () {
                	//age = App.current_user.details.age;
                    Lungo.dom(".male_original_image").attr("src", "img/face/"+App.current_user.details.age+"/m_"+App.current_user.details.age+"_0.png");
                    Lungo.dom(".male_red_check_image").hide();
                }
            }
    	},
    	gender_female : function () { 
        	return {
                active : function () {
                	Lungo.dom(".female_original_image").attr("src", "img/face/"+App.current_user.details.age+"/f_"+App.current_user.details.age+"_0.png");
                	Lungo.dom(".female_red_check_image").show();
                },
                inactive : function () {
                	Lungo.dom(".female_original_image").attr("src", "img/face/"+App.current_user.details.age+"/f_"+App.current_user.details.age+"_0.png");
                	Lungo.dom(".female_red_check_image").hide();
                }
            }
    	},
    	skin_color1 : function () {
        	return {
                active : function () {
                	Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
                	$(".skin_color_1_checked").show();
                },
                inactive : function () {
                    $(".skin_color_1_checked").hide();
                }
            }
    	},
    	skin_color2 : function () {
        	return {
                active : function () {
                	Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
                	$(".skin_color_2_checked").show();
                },
                inactive : function () {
                    $(".skin_color_2_checked").hide();
                }
            }
    	},
    	skin_color3 : function () {
        	return {
                active : function () {
                	Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
                	$(".skin_color_3_checked").show();
                },
                inactive : function () {
                    $(".skin_color_3_checked").hide();
                }
            }
    	},
    	skin_color4 : function () {
        	return {
                active : function () {
                	Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
                	$(".skin_color_4_checked").show();
                },
                inactive : function () {
                    $(".skin_color_4_checked").hide();
                }
            }
    	},
    	skin_color5 : function () {
        	return {
                active : function () {
                	Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
                	$(".skin_color_5_checked").show();
                },
                inactive : function () {
                    $(".skin_color_5_checked").hide();
                }
            }
    	},
    	skin_color6 : function () {
        	return {
                active : function () {
                	Lungo.dom(".skin_face_image").attr("src", "img/face/"+App.current_user.details.age+"/"+App.question_data.gender+"_"+App.current_user.details.age+"_"+App.question_data.skin_color+".png");
                	$(".skin_color_6_checked").show();
                },
                inactive : function () {
                    $(".skin_color_6_checked").hide();
                }
            }
    	},
    	acne_none : function () {
        	return {
                active : function () {
                	 Lungo.dom(".acne_mask_image").hide();
                     $(".acne_none").css("background-image", "url(img/acne_bg.png)");
                     $(".acne_none_text").css("color", "#fff");
                     $(".acne_none_img").show();
                },
                inactive : function () {
                	$(".acne_none").css("background-image", "url(img/acne_bg_inactive.png)");
                    $(".acne_none_text").css("color", "#000");
                    $(".acne_none_img").hide();
                }
            }
    	},
    	acne_few : function () {
        	return {
                active : function () {
                	 Lungo.dom(".acne_mask_image").show();
                	 Lungo.dom(".acne_mask_image").attr("src", "img/acne_few.png");                	 
                     $(".acne_few").css("background-image", "url(img/acne_bg.png)");
                     $(".acne_few_text").css("color", "#fff");
                     $(".acne_few_img").show();
                },
                inactive : function () {
                	$(".acne_few").css("background-image", "url(img/acne_bg_inactive.png)");
                    $(".acne_few_text").css("color", "#000");
                    $(".acne_few_img").hide();
                }
            }
    	},
    	acne_many : function () {
        	return {
                active : function () {
                	 Lungo.dom(".acne_mask_image").show();
                	 Lungo.dom(".acne_mask_image").attr("src", "img/acne_many.png");                	 
                     $(".acne_many").css("background-image", "url(img/acne_bg.png)");
                     $(".acne_many_text").css("color", "#fff");
                     $(".acne_many_img").show();
                },
                inactive : function () {
                	$(".acne_many").css("background-image", "url(img/acne_bg_inactive.png)");
                    $(".acne_many_text").css("color", "#000");
                    $(".acne_many_img").hide();
                }
            }
    	},
    	freckle_none : function () {
        	return {
                active : function () {
                	 Lungo.dom(".freckle_mask_image").hide();
                     $(".freckle_none").css("background-image", "url(img/acne_bg.png)");
                     $(".freckle_none_text").css("color", "#fff");
                     $(".freckle_none_img").show();
                },
                inactive : function () {
                	$(".freckle_none").css("background-image", "url(img/acne_bg_inactive.png)");
                    $(".freckle_none_text").css("color", "#000");
                    $(".freckle_none_img").hide();
                }
            }
    	},
    	freckle_yes : function () {
        	return {
                active : function () {
                	 Lungo.dom(".freckle_mask_image").show();
                	 Lungo.dom(".freckle_mask_image").attr("src", "img/freckle.png");  
                     $(".freckle_yes").css("background-image", "url(img/acne_bg.png)");
                     $(".freckle_yes_text").css("color", "#fff");
                     $(".freckle_yes_img").show();
                },
                inactive : function () {
                	$(".freckle_yes").css("background-image", "url(img/acne_bg_inactive.png)");
                    $(".freckle_yes_text").css("color", "#000");
                    $(".freckle_yes_img").hide();
                }
            }
    	}
	}
}

Lungo.Events.init({
    'tap .male_image': function() {
	    App.question_data.gender = "m";
    	App.component().gender_male().active();
    	App.component().gender_female().inactive();
    },
    'tap .female_image': function() {
	    App.question_data.gender = "f";
    	App.component().gender_male().inactive();
    	App.component().gender_female().active();
    },
    'tap .skin_color_1': function() {
	    App.question_data.skin_color = 1;
    	App.component().skin_color1().active();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_2': function() {
    	App.question_data.skin_color = 2;
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().active();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_3': function() {
	    App.question_data.skin_color = 3;
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().active();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_4': function() {
	    App.question_data.skin_color = 4;    
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().active();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_5': function() {
	    App.question_data.skin_color = 5;    
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().active();
    	App.component().skin_color6().inactive();
    },
    'tap .skin_color_6': function() {
	    App.question_data.skin_color = 6;    
    	App.component().skin_color1().inactive();
    	App.component().skin_color2().inactive();
    	App.component().skin_color3().inactive();
    	App.component().skin_color4().inactive();
    	App.component().skin_color5().inactive();
    	App.component().skin_color6().active();
    },
    'tap .acne_none': function() {
	    App.question_data.acne = "none";    
    	App.component().acne_none().active();
    	App.component().acne_few().inactive();
    	App.component().acne_many().inactive();
    },
    'tap .acne_few': function() {
	    App.question_data.acne = "few";      
    	App.component().acne_none().inactive();
    	App.component().acne_few().active();
    	App.component().acne_many().inactive();
    },
    'tap .acne_many': function() {
	    App.question_data.acne = "many";      
    	App.component().acne_none().inactive();
    	App.component().acne_few().inactive();
    	App.component().acne_many().active();
    },
    'tap .freckle_none': function() {
	    App.question_data.freckle = "none";      
    	App.component().freckle_none().active();
    	App.component().freckle_yes().inactive();
    },
    'tap .freckle_yes': function() {
	    App.question_data.freckle = "yes";      
    	App.component().freckle_none().inactive();
    	App.component().freckle_yes().active();
    },
});
