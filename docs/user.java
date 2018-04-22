package cs_robot;

public class user {

	String[] usernames = new String[200];
	String[] passwds = new String[500];
	int[] phones = new int[500];
	
	//获取用户名称
	private String getUserName(){
		String username = null;
		return username;
	}
		
	//获取用户密码
	private String getPasswd(){
		String passwd = null;
		return passwd;
	}
		
	//将获取的用户名称和密码和数据库进行匹配，如果匹配正确，则登录。如果数据库中没有找到相应名称则在数据库中添加
	private boolean login(String username,String passwd){
			
		return true;
	}
		
	//获取用户发送信息的关键字在数据库中进行匹配
	private String getMessage(String message){
		String key = null;
		return key;
	}
		
	//修改用户信息：用户名，密码，性别，年龄
	private void updateUserMessage(){
			
	}
		
	//注销用户
	private void deleteUser(){
			
	}
	
}

