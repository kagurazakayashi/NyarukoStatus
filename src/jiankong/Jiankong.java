/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jiankong;

import java.util.Date;

/**
 *
 * @author yashi
 */
public class Jiankong {
    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws InterruptedException {
        // TODO code application logic here
        System.out.println((new Date())+" - 雅诗服务器监控程序启动。uuu.moe");
        startpgm g = new startpgm();
        g.start();
    }

    


}
