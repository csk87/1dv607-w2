<?php
namespace View;

class AddBoatView {
    private static $type = 'AddMemberView::select';
    private static $length = 'AddMemberView::length';
    private static $add = 'AddMemberView::add';
    public function render() {
       echo 
       '<h3>Enter boat information<h3>  
       <select name="'.self::$type.'">
        <option value="Sailboat">Sailboat</option>
        <option value="Motorsailer">Motorsailer</option>
        <option value="Kayak/Canoe">Kayak/Canoe</option>
        <option value="Other">Other</option>
       </select>
       <form method="post"> 
       <label for="">Length:</label>
       <input type="text" id="" name="'.self::$type.'" value="" />
       <br>
       <input type="submit" name="'.self::$add.'" value="Add Boat" />
       </form>
    ';
    
    }
}