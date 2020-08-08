<?php
use Illuminate\Support\Facades\Date;
use Auth as Auth;

if(!function_exists('flash')){
function flash($message,$type){
session()->flash('message',$message);
session()->flash('type',$type);
}};

if(!function_exists('date_publication')){
function date_publication(DateTime $date){
if ((new DateTime(Date::now()))->format('d/m/y') ===$date->format('d/m/y')){
	return 'le '.$date->format('H:i');
}
if ((new DateTime(Date::now()))->format('m/y') === $date->format('m/y')){
return'le '.$date->format('d').' à '.$date->format('H:i');
}
if ((new DateTime(Date::now()))->format('y') ===$date->format('y')){
return 'le '.$date->format('d/m').' à '.$date->format('H:i');
}
return 'le '.$date->format('d/m/y').' à '.$date->format('H:i');
}};




if(!function_exists('publication_user')){
function publication_user($publication,$donors,$demandeurs){
if($publication->publicatable_type === 'Donor'){
	return $donors->find($publication->publicatable_id)->phone;
}
else{
	if($publication->publicatable_type === 'Demandeur'){
	return $demandeurs->find($publication->publicatable_id)->phone;
}
else
	return "";
}
}};
/*
if(!function_exists('loggedin')){
    if(Auth::guard('donor')->check()){
      return true;
	}
	if(Auth::guard('membre')->check()){
		return true;
	  }
      if(Auth::guard('demandeur')->check()){
		return true;
	  }
	  if(Auth::guard('admin')->check()){
		return true;
	  }
	};

*/