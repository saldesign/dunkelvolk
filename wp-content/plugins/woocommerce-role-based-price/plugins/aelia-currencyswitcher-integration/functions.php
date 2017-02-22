<?php 

if(!function_exists('wc_rbp_update_acs_role_based_price')){
	/**
	 * Updates Products Role Based Price Array In DB
	 * @param  int $post_id     Post ID To Update
	 * @param  array $price_array Price List
	 * @return boolean  [[Description]]
	 */
	function wc_rbp_update_acs_role_based_price($post_id,$price_array){
		update_post_meta($post_id,'_acs_role_based_price', $price_array);
		return true;
	}
}

if(!function_exists('wc_rbp_get_acs_product_price')){

	/**
	 * Gets Product price from DB
	 * #TODO Integrate Wth product_rbp_price function to make it faster
	 */
	function wc_rbp_get_acs_product_price($post_id,$supress_filter = false){
		$price = get_post_meta($post_id,'_acs_role_based_price');
        
		if(!empty($price)) {$price = $price[0];}
		else if(empty($price)) {$price = array();}
		if(!$supress_filter)
			$price = apply_filters('wc_rbp_product_acs_prices',$price);
        
		return $price;
	}
	
}

if(!function_exists('product_acs_rbp_price')){
	/**
	 * Gets product price from DB
	 */
	function product_acs_rbp_price($post_id,$productOBJ = null){
		global $product;
        
        /* $price = wc_rbp_get_acs_product_price($post_id);
        return $price;

        if(is_null($product) && is_null($productOBJ) ){
            $price = wc_rbp_get_acs_product_price($post_id);
            return $price;
        } else if(!is_null($productOBJ)){
            
            if($productOBJ->id == $post_id &&  ( isset($productOBJ->post->wc_rbp_acs) && ! empty($productOBJ->post->wc_rbp_acs)))  {
                return $productOBJ->post->wc_rbp_acs;    
            }
            
        } else if(!is_null($product)){
            if($product->id == $post_id && ( isset($product->post->wc_rbp_acs) && ! empty($product->post->wc_rbp_acs)) ){
                return $product->post->wc_rbp_acs;    
            }
            
        } else {
            $price = wc_rbp_get_acs_product_price($post_id);
            return $price;
        }     
        
		$price = wc_rbp_get_acs_product_price($post_id);
        return $price;*/
        
        
        
        if(is_null($product) && is_null($productOBJ) ){
            $price = wc_rbp_get_acs_product_price($post_id);
            return $price;
        }

        if(!is_null($productOBJ)){
             if($productOBJ->id == $post_id){
                 if(isset($productOBJ->post->wc_rbp_acs) && !empty($productOBJ->post->wc_rbp_acs)) {
                    return $productOBJ->post->wc_rbp_acs;   
                 }
             }
        } 

        if(!is_null($product)){
            if($product->id == $post_id){
                if(isset($product->post->wc_rbp_acs) && !empty($product->post->wc_rbp_acs)) {
                    return $product->post->wc_rbp_acs;    
                }
            }
        }
 
        
		$price = wc_rbp_get_acs_product_price($post_id);
        
        return $price;
	}
}

if(!function_exists('wc_rbp_acs_price')){
	/**
	 * Returns Price Based On Give Value
	 * @role : enter role slug / use all to get all roles values
	 * @price : use selling_price / regular_price or use all to get all values for the given role
	 */
	function wc_rbp_acs_price($post_id,$role,$currency,$price = 'regular_price',$product = null,$args = array()){
		$dbprice = product_acs_rbp_price($post_id,$product); 

		$return = false; 
		
		if($price == 'all' && $role == 'all'){
			$return = $dbprice;
		} else if($price == 'all' && $role !== 'all'){
			if(isset($dbprice[$role])){
				$return = $dbprice[$role];
			}			
		} else if(isset($dbprice[$role][$currency][$price])){
			$return = $dbprice[$role][$currency][$price];
		}
 

        $return = apply_filters('wc_rbp_product_acs_price',$return,$role,$price,$post_id,$args);
        
		return $return;
	}
}