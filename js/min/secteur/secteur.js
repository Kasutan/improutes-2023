!function(p){p(document).ready(function(){var l,h,f,t,s=p(".filtre-realisations"),r=(p(s).find("input").prop("checked",!1),p("section.diaporama"));function c(s){var e,t;p(window).width()<960||(p(s).css("left",0),p(s).attr("data-slide-active",0),p(s).find(".photo").removeAttr("slide"),p(s).find(".photo").removeClass("first-slide"),p(s).find(".photo").removeClass("last-slide"),s=p(s).find(".photo.js-show"),3<(e=p(s).length)?(p(".fleche").show(),t=e-3,p(s).each(function(s){p(this).attr("slide",s),0==s?p(this).addClass("first-slide"):s==t&&p(this).addClass("last-slide")})):p(".fleche").hide())}function u(s,e){var t=".photo[slide="+p(e).attr("data-slide-active")+"]",e=p(e).find(t),t=p(e).hasClass("first-slide"),t=(p(s).find(".fleche.gauche").attr("disabled",t),p(e).hasClass("last-slide"));p(s).find(".fleche.droite").attr("disabled",t)}0<r.length?(l=p(this).find(".slider"),h=p(this).find(".photo"),f=p(s).find("#toutes").parent(".field-group"),p(h).addClass("js-show"),p(l).find(".aucune").removeClass("js-show"),t=p(l).find(".photo.js-show").outerWidth(!0),c(l),u(r,l),p(r).find(".fleche").click(function(s){s.preventDefault();var s=p(l).attr("data-slide-active"),e=-1*(s=p(this).hasClass("droite")?parseInt(s)+1:s-1)*t;e+="px",p(l).css("left",e),p(l).attr("data-slide-active",s),u(r,l)}),p(s).change(function(s){var e,t,a,i,d,n,o=p(this).find("input:checked").val();e=r,a=h,i=o,d=f,n=p(t=l).find(".aucune"),p(t).animate({opacity:0},400,"linear",function(){var s;"toutes"==i?(p(a).addClass("js-show"),p(n).removeClass("js-show"),p(d).fadeOut()):(p(a).removeClass("js-show"),0<(s=p(t).find("."+i)).length?(p(s).addClass("js-show"),p(n).removeClass("js-show")):p(n).addClass("js-show"),p(d).fadeIn()),c(t),u(e,t),p(t).animate({opacity:1},1e3,"linear")})})):p(s).find("input").prop("disabled",!0)})}(jQuery);