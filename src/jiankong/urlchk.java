/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jiankong;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.Date;

/**
 *
 * @author yashi
 */
public class urlchk {

    public String htmlstart() {
        return "<!doctype html><html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\"><title>雅诗服务器监控</title></head><body><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tbody>";
    }
    
    public String htmlend() {
        return "</tbody></table></body></html>";
    }
    
    public String chkurl(String httpUrl, String outdir) {
        //获得的数据
        String urlmd5 = startpgm.MD5(httpUrl);
        String resultData = "";
        URL url = null;
        try {
            //构造一个URL对象
            url = new URL(httpUrl);
        } catch (MalformedURLException e) {
            return logurl(urlmd5, "URL有错误", "× OFFLINE(2)", "red", outdir);
        }
        if (url != null) {
            try {
                //使用HttpURLConnection打开连接
                HttpURLConnection urlConn = (HttpURLConnection) url.openConnection();
                //得到读取的内容(流)
                InputStreamReader in = new InputStreamReader(urlConn.getInputStream());
                // 为输出创建BufferedReader
                BufferedReader buffer = new BufferedReader(in);
                String inputLine = null;
                //使用循环来读取获得的数据
                while (((inputLine = buffer.readLine()) != null)) {
                    //我们在每一行后面加上一个"\n"来换行
                    resultData += inputLine + "";
                }
                //关闭InputStreamReader
                in.close();
                //关闭http连接
                urlConn.disconnect();
                //设置显示取得的内容
                if (resultData != null) {
                    if (resultData.equals("YashiServerOK")) {
                        return logurl(urlmd5, "工作正常", "√ ONLINE(0)", "green", outdir);
                    } else {
                        return logurl(urlmd5, "仅链接成功", "－ MAINTENANCE(1)", "GoldenRod", outdir);
                    }
                } else {
                    return logurl(urlmd5, "获得了空白内容", "× OFFLINE(3)", "red", outdir);
                }
            } catch (IOException e) {
                return logurl(urlmd5, "内容读取失败", "× OFFLINE(4)", "red", outdir);
            }
        } else {
            return logurl(urlmd5, "URL空白", "× OFFLINE(5)", "red", outdir);
        }
    }

    private String logurl(String urlmd5, String showlog, String txt, String color, String outdir) {
        SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");//设置日期格式
        String cmdlog = df.format(new Date()) + "｜" + urlmd5 + "｜" + showlog + "｜" + txt;
        System.out.println(cmdlog);
        txt = "<!--" + cmdlog + "--><p align=\"right\"><font color=\"" + color + "\" size=\"3\" face=\"Verdana\">" + txt + "</font></p>";
        return txt;
    }

    
}
