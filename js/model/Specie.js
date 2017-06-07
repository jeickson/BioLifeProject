/* @name: User
 * @author: Frias Marte Jeickson
 * @date: 02/06/2017
 * @description: describes the Specie data
 * @methods:
 *      construct
 *      set's and get's foor each attribute
 *
*/

function Specie()
{
    //Attributes declaration
    this.id;
    this.name;
    this.description;
    this.livingBeing;
    this.img;

    //methods declaration
    this.construct = function (id, name,description,livingBeing,img)
    {
        this.setId(id);
        this.setName(name);
        this.setDescription(description);
        this.setLivingBeing(livingBeing);
        this.setImg(img);
        
    }
    
    //setters
    this.setId = function (id) {this.id=id;}
    this.setName = function (name) {this.name=name;}
    this.setDescription = function (description) {this.description=description;}
    this.setLivingBeing = function (livingBeing) {this.livingBeing=livingBeing;}
   this.setImg = function (img) {this.img=img;}
    

    //getters
    this.getId = function () {return this.id;}
    this.getName = function () {return this.name;}
    this.getDescription = function () {return this.description;}
    this.getLivingBeing = function () {return this.livingBeing;}
     this.getImg = function () {return this.img;}

  
    this.toString = function ()
    {
    	
    }
}
