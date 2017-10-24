<?php

namespace DieSchittigs\StarScraper;

class StaticBrowser{
    private static $browser;
    public static function getBrowser(){
        if(!self::$browser){
            self::$browser = new \Buzz\Browser();
        }
        return self::$browser;
    }
}

trait BrowserTrait {
    public function getBrowser() {
        return StaticBrowser::getBrowser();
    }
}
