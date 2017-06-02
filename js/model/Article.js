/* @name: User
 * @author: Frias Marte Jeickson
 * @date: 02/06/2017
 * @description: describes the Article data
 * @methods:
 *      construct
 *      set's and get's foor each attribute
 *
*/

function Article()
{
    //Attributes declaration
    this.id;
    this.title;
    this.abstract;
    this.status;
    this.user;
    this.date;
    this.code;
    

    //methods declaration
    this.construct = function (id, title, abstract, status, user, date, code)
    {
        this.setId(id);
        this.setTitle(title);
        this.setAbstract(abstract);
        this.setStatus(status);
        this.setUser(user);
        this.setDate(date);
        this.setCode(code);
        
    }
    
    //setters
    this.setId = function (id) {this.id=id;}
    this.setTitle = function (title) {this.title=title;}
    this.setAbstract = function (abstract) {this.abstract=abstract;}
    this.setStatus = function (status) {this.status=status;}
    this.setUser = function (user) {this.user=user;}
    this.setDate = function (date) {this.date=date;}
    this.setCode = function (code) {this.code=code;}
    

    //getters
    this.getId = function () {return this.id;}
    this.getTitle = function () {return this.title;}
    this.getAbstract = function () {return this.abstract;}
    this.getStatus = function () {return this.status;}
    this.getUser = function () {return this.user;}
    this.getDate = function () {return this.date;}
    this.getCode = function () {return this.code;}

   
    this.toString = function ()
    {
    	
    }
}
