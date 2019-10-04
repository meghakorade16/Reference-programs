
var checkbox_select = function(params)
{
    var that            = this,
        $_native_form   = $(params.selector),
        $_native_select = $_native_form.find('select'),
        /* required Variables */
        selector                = params.selector,
        select_name             = document.getElementById("multiple_select_dropdown").name,
        selected_translation    = "selected",
        all_translation         = params.all_translation        ? params.all_translation        : "All " + select_name + "s",
        not_found_text          = params.not_found              ? params.not_found              : "No " + select_name + "s found.",
        selected = [],
        
        // Create the elements needed for the checkbox select
        $_parent_div    = $("<div />")      .addClass("checkbox_select"),
        $_select_anchor = $("<a />")        .addClass("checkbox_select_anchor")     .text( select_name ),
        $_search        = $("<input />")    .addClass("checkbox_select_search").attr('placeholder','Search..'),
//        $_submit        = $("<input />")    .addClass("checkbox_select_submit")     .val("Apply") .attr('type','submit') .data("selected", ""),
        $_dropdown_div  = $("<div />")      .addClass("checkbox_select_dropdown"),
        $_not_found     = $("<span />")     .addClass("not_found hide")             .text(not_found_text),
        $_ul            = $("<ul />"),

        updateCurrentlySelected = function() {
 
            if(selected.length == 0)
            {
            	$_select_anchor.text(select_name)
            }
            else if(selected.length <= 2)
            {
                $_select_anchor.text( selected + " " + selected_translation );
            }
            else if(selected.length == document.querySelectorAll("input[type=checkbox]").length - 1)
            {
            	$_select_anchor.text( all_translation );
            }
            else
            {
                $_select_anchor.text( selected.length + " items " + selected_translation );
            }
        },

        // Template for the li, will be used in a loop.
        createItem  = function(name, value, count)
        {
            var uID             = 'checkbox_select_' + select_name + "_" + name.replace(" ", "_"),
                $_li            = $("<li />"),
                $_checkbox      = $("<input />").attr(
                                        {
                                            'name'  : name,
                                            'id'    : uID,
                                            'type'  : "checkbox",
                                            'value' : value
                                        }
                                    )
                                    .click(
                                        function()
                                        {
                                        	var t0 = performance.now();
                                        	var totalElements = document.querySelectorAll("input[type=checkbox]").length - 1;
                                        	if($(this).val() == "all") {
                                        		if(this.checked) {
                                        			console.log("adding all the elements to list..");
                                        			document.querySelectorAll("input[type=checkbox]").forEach(function(element) {
    													if(element.value != "all" && !selected.includes(element.value)) {
    														element.checked = true;
    														selected.push(element.value);
    													}
    												});
                                        		} else {
                                        			console.log("removing all the element ");
                                        			document.querySelectorAll("input[type=checkbox]").forEach(function(element) {
                                        				element.checked = false;
    												});
                                        			selected = [];
                                        		}
                                        	} else {
                                        		if(this.checked) {
													console.log("pushing " + this.value +" to list...");
                                        			selected.push(this.value);
												} else {
													console.log("removing " + this.value + " from list");
													selected.splice(selected.indexOf(this.value), 1);	
												}
											}
                                        	if(selected.length == totalElements) {
                                        		document.querySelector("input[type=checkbox][value=all]").checked = true;
                                        	} else {
                                        		document.querySelector("input[type=checkbox][value=all]").checked = false;
											}
                                        	selected.sort();
                                        	updateCurrentlySelected();
                                        	console.log(selected);
                                        	var t1 = performance.now();
                                        	console.log("JavaScript code execution time: "+ (t0 - t1) + " milliseconds");
                                        }
                                    ),

                $_label         = $("<label />").attr('for', uID),
                $_name_span     = $("<span />").text(name).prependTo($_label),
                $_count_span    = $("<span />").text(count).appendTo($_label);
                        
            return $_li.append( $_checkbox.after( $_label ) );
        },
		
		apply = function()
		{
			$_dropdown_div.toggleClass("show");
			$_parent_div.toggleClass("expanded");
				
			/*
			 * commenting this segment temporarily
			 * if(!$_parent_div.hasClass("expanded"))
			{  
				// Only do the Apply event if its different
				if(currently_selected != $_submit.data("selected"))
				{
					$_submit.data("selected" , currently_selected);

					that.onApply(
						{ 
							selected : $_submit.data("selected")
						}
					);
				}		
			}	*/				
		};
    
    // Event of this instance
    that.onApply = typeof params.onApply == "function" ? 
                
                    params.onApply :
                
                    function(e) 
                    {
                        //e.selected is accessible
                    };

    that.update = function() 
    {
        $_ul.empty();
        $_native_select.find("option").each(

            function(i)
            {
                $_ul.append( createItem( $(this).text(), $(this).val(), $(this).data("count") ) );
            }
        );

        updateCurrentlySelected();
    }

    that.check = function(checkbox_name, checked) 
    {
        //$_ul.find("input[type=checkbox][name=" + trim(checkbox_name) + "]").attr('checked', checked ? checked : false);

		$_ul.find("input[type=checkbox]").each(function()
		{
			// If this elements name is equal to the one sent in the function
			if($(this).attr('name') == checkbox_name)
			{
				// Apply the checked state to this checkbox
				$(this).attr('checked', checked ? checked : false);
				
				// Break out of each loop
				return false;
			}
		});
		
        updateCurrentlySelected();

    }

    // Build mark up before pushing into page
    $_dropdown_div  .prepend($_search);
    $_dropdown_div  .append($_ul);
    $_dropdown_div  .append($_not_found);
    $_dropdown_div  .appendTo($_parent_div);
    $_select_anchor .prependTo($_parent_div);

    // Iterate through option elements
    that.update();

    // Events 

    // Actual dropdown action
    $_select_anchor.click(

        function()
        {
            apply();
        }
    );
             
    // Filters the checkboxes by search on keyup
    $_search.keyup(

        function()
        {
            var search = $(this).val().toLowerCase().trim();

            if( search.length == 1 )
            {
                $_ul.find("label").each(

                    function()
                    {
                        if($(this).text().toLowerCase().charAt(0) == search.charAt(0))
                        {
                            if($(this).parent().hasClass("hide"))
                                $(this).parent().removeClass("hide");

                            if(!$_not_found.hasClass("hide"))
                                $_not_found.addClass("hide");
                        }
                        else
                        {
                            if(!$(this).parent().hasClass("hide"))
                                $(this).parent().addClass("hide");

                            if($_not_found.hasClass("hide"))
                                $_not_found.removeClass("hide");
                        }
                    }
                );
            }
            else
            {
                // If it doesn't contain 
                if($_ul.text().toLowerCase().indexOf(search) == -1)
                {
                    if($_not_found.hasClass("hide"))
                        $_not_found.removeClass("hide");
                }
                else
                {
                    if(!$_not_found.hasClass("hide"))
                        $_not_found.addClass("hide");
                }
                    
                $_ul.find("label").each(

                    function()
                    {
                        if($(this).text().toLowerCase().indexOf(search) > -1)
                        {
                            if($(this).parent().hasClass("hide"))
                                $(this).parent().removeClass("hide");
                        }
                        else
                        {
                            if(!$(this).parent().hasClass("hide"))
                                $(this).parent().addClass("hide");
                        }
                    }
                );
            }
        }
    );

//    $_submit.click(
//                
//        function(e)
//        {
//            e.preventDefault();
//
//            apply();
//        }
//    );

    // Delete the original form submit
    $(params.selector).find('input[type=submit]').remove();

    // Put finalized markup into page.
    $_native_select.after($_parent_div);

    // Hide the original element
    $_native_select.hide();
};