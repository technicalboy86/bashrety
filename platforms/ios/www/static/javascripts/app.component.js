App.component = function() {
	return {
		gender_male : function () {
        	return {
                active : function () {
                	Lungo.dom(".male_image").attr("src", "img/s_m026_face0000.png");
                },
                inactive : function () {
                    Lungo.dom(".male_image").attr("src", "img/m026_face0000.jpg");
                }
            }
    	},
    	gender_female : function () {
        	return {
                active : function () {
                	Lungo.dom(".female_image").attr("src", "img/s_f021_face0000_2.png");
                },
                inactive : function () {
                    Lungo.dom(".female_image").attr("src", "img/f021_face0000_2.jpg");
                }
            }
    	},
    	skin_color1 : function () {
        	return {
                active : function () {
                	Lungo.dom(".face_image").attr("src", "img/faces/01a-color1.jpg");
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
                	Lungo.dom(".face_image").attr("src", "img/faces/01b-color2.jpg");
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
                	Lungo.dom(".face_image").attr("src", "img/faces/01c-color3.jpg");
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
                	Lungo.dom(".face_image").attr("src", "img/faces/01d-color4.jpg");
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
                	Lungo.dom(".face_image").attr("src", "img/faces/01e-color5.jpg");
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
                	Lungo.dom(".face_image").attr("src", "img/faces/01f-color6.jpg");
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
                	 Lungo.dom(".acne_face_image").attr("src", "img/faces/00-original.jpg");
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
                	 $(".acne_face_image").attr("src", "img/faces/05c-acne03.jpg");
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
                	 $(".acne_face_image").attr("src", "img/faces/05d-acne04.jpg");
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
                	 $(".freckle_face_image").attr("src", "img/faces/00-original.jpg");
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
                	 $(".freckle_face_image").attr("src", "img/faces/04b-frackle2.jpg");
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
    	},
	}
}
  