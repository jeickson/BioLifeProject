/* @name: User
 * @author: Luis Jeickson Frias Marte
 * @date: 30/04/2017
 * @description: describes the user data
 * @methods:
 *      construct
 *      set's and get's foor each attribute
 *
*/

function User()
{
    //Attributes declaration

    this.nick;
    this.password;
    this.name;
    this.surname;
    this.email;
    this.age;
    this.birthdate;
    this.address;
    this.role;

    //methods declaration
    this.construct = function (nick, password, name, surname, email, age, birthdate, address, role)
    {
        this.setNick(nick);
        this.setPassword(password);
        this.setName(name);
        this.setSurname(surname);
        this.setEmail(email);
        this.setAge(age);
        this.setBirthdate(birthdate);
        this.setAddress(address);
        this.setRole(role);
    }

    //setters

    this.setNick = function (nick) {this.nick=nick;}
    this.setPassword = function (password) {this.password=password;}
    this.setName = function (name) {this.name=name;}
    this.setSurname = function (surname) {this.surname=surname;}
    this.setEmail = function (email) {this.email=email;}
    this.setAge = function (age) {this.age=age;}
    this.setBirthdate = function (birthdate) {this.birthdate=birthdate;}
    this.setAddress = function (address) {this.address=address;}
    this.setRole = function (role) {this.role=role;}

    //getters

    this.getNick = function () {return this.nick;}
    this.getPassword = function () {return this.password;}
    this.getName = function () {return this.name;}
    this.getSurname = function () {return this.surname;}
    this.getEmail = function () {return this.email;}
    this.getAge = function () {return this.age;}
    this.getBirthdate = function () {return this.birthdate;}
    this.getAddress = function () {return this.address;}
    this.getRole = function () {return this.role;}

    
    this.toString = function ()
    {
    	var userString =" nick="+this.getNick()+" password="+this.getPassword()+" name="+this.getName()
      +" surname="+this.getSurname()+" email="+this.getEmail()+" age="+this.getAge()+
      " birthDate="+this.getBirthdate()+" role="+this.getRole();

    	return userString;
    }
}
