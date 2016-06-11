/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jiankong;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.security.MessageDigest;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author yashi
 */
public class startpgm {

    ArrayList<String> urlArray = new ArrayList<String>();
    ArrayList<String> nameArray = new ArrayList<String>();
    ArrayList<String> infoArray = new ArrayList<String>();

    public void start() throws InterruptedException {
        
        String rundir = "D:\\web\\web_status\\"; 
        //  /Volumes/RAM/  D:\\web\\web_status\\
        int sl = 300000;
        //YashiServerOK
        
        readTxtFile(rundir);
        int z = 0;
        //for (;;) {
            z++;
            System.out.println((new Date())+" - 开始第 "+z+" 回测试");
            urlchk uc = new urlchk();
            ArrayList<String> htmlArray = new ArrayList<String>();
            htmlArray.add(uc.htmlstart());
            for (int j = 0; j < urlArray.size(); j++) {
                htmlArray.add("<tr><td height=\"60\"><span style=\"font-size: medium\">");
                htmlArray.add(nameArray.get(j));
                htmlArray.add("</span><br><span style=\"font-size: small; color: #7F7F7F;\">");
                htmlArray.add(infoArray.get(j));
                htmlArray.add("</span></td><td height=\"60\" align=\"right\">");
                htmlArray.add(uc.chkurl(urlArray.get(j), rundir));
                htmlArray.add("</td></tr>");
            }
            htmlArray.add(uc.htmlend());
            String html = "";
            for (int k = 0; k < htmlArray.size(); k++) {
                html = html + htmlArray.get(k);
            }
            String fileAddress = rundir + "status.html";
            writeTxtFile(fileAddress,html);
            System.out.println((new Date())+" - 创建状态显示网页完毕。");
            ArrayList<String> thtmlArray = new ArrayList<String>();
            thtmlArray.add("<!doctype html><html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"><title>");
            thtmlArray.add("雅诗服务器监控</title></head>");
            thtmlArray.add("<body text=\"#FFFFFF\"><right>上次更新时间：");
            SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");//设置日期格式
            String t = df.format(new Date());
            thtmlArray.add(t);
            thtmlArray.add("</right></body></html>");
            String thtml = "";
            for (int l = 0; l < thtmlArray.size(); l++) {
                thtml = thtml + thtmlArray.get(l);
            }
            String timeAddress = rundir + "time.html";
            writeTxtFile(timeAddress,thtml);
            System.out.println((new Date())+" - 创建时间记录网页完毕。");
            //System.out.println((new Date())+" - 程序休眠（"+sl+"）");
            //Thread.sleep(sl);
        //}
    }

    public void writeTxtFile(String filePath, String txt) {
        try {
                FileWriter fw = new FileWriter(filePath, false);
                fw.write(txt, 0, txt.length());
                fw.flush();
                fw.close();
            } catch (IOException ex) {
                Logger.getLogger(urlchk.class.getName()).log(Level.SEVERE, null, ex);
            }
    }
    
    public void readTxtFile(String filePath) {
        filePath = filePath + "option.txt";
        try {
            String encoding = "UTF-8";
            File file = new File(filePath);
            if (file.isFile() && file.exists()) { //判断文件是否存在
                InputStreamReader read = new InputStreamReader(
                        new FileInputStream(file), encoding);//考虑到编码格式
                BufferedReader bufferedReader = new BufferedReader(read);
                int arrmode = 0;
                String lineTxt = null;
                while ((lineTxt = bufferedReader.readLine()) != null) {
                    if (lineTxt.endsWith("[url]")) {
                        arrmode = 1;
                    } else if (lineTxt.endsWith("[name]")) {
                        arrmode = 2;
                    } else if (lineTxt.endsWith("[info]")) {
                        arrmode = 3;
                    } else {
                        if (arrmode == 1) {
                            urlArray.add(lineTxt);
                        } else if (arrmode == 2) {
                            nameArray.add(lineTxt);
                        } else if (arrmode == 3) {
                            infoArray.add(lineTxt);
                        }
                    }
                }
                read.close();
                System.out.println((new Date())+" - 载入设置完成。");
            } else {
                System.out.println((new Date())+" - 找不到指定的文件！");
            }
        } catch (Exception e) {
            System.out.println((new Date())+" - 读取文件内容出错！");
            e.printStackTrace();
        }
    }

    public final static String MD5(String s) {
        char hexDigits[] = {'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'};
        try {
            byte[] btInput = s.getBytes();
            // 获得MD5摘要算法的 MessageDigest 对象
            MessageDigest mdInst = MessageDigest.getInstance("MD5");
            // 使用指定的字节更新摘要
            mdInst.update(btInput);
            // 获得密文
            byte[] md = mdInst.digest();
            // 把密文转换成十六进制的字符串形式
            int j = md.length;
            char str[] = new char[j * 2];
            int k = 0;
            for (int i = 0; i < j; i++) {
                byte byte0 = md[i];
                str[k++] = hexDigits[byte0 >>> 4 & 0xf];
                str[k++] = hexDigits[byte0 & 0xf];
            }
            return new String(str);
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }
}
