/* @name: User
 * @author: Frias Marte Jeickson
 * @date: 02/06/2017
 * @description: describes the Article data
 * @methods:
 *      construct
 *      set's and get's foor each attribute
 *
*/

function Code()
{
    //Attributes declaration
    this.id;
    this.specie;
    this.name;
    this.description;
    this.type;
    this.length;
    this.weight;
    

    //methods declaration
    this.construct = function (id, specie, name, type, length, weight)
    {
        this.setId(id);
        this.setSpecie(specie);
        this.setName(name);
        this.setType(type);
        this.setLength(length);
        this.setWeight(weight);

        
    }
    
    //setters
    this.setId = function (id) {this.id=id;}
    this.setSpecie = function (specie) {this.specie=specie;}
    this.setName = function (name) {this.name=name;}
    this.setType = function (type) {this.type=type;}
    this.setLength = function (length) {this.length=length;}
    this.setWeight = function (weight) {this.weight=weight;}
   
    

    //getters
    this.getId = function () {return this.id;}
    this.getSpecie = function () {return this.specie;}
    this.getName = function () {return this.name;}
    this.getType = function () {return this.type;}
    this.getLength = function () {return this.length;}
    this.getWeight = function () {return this.weight;}


  
    this.toString = function ()
    {
    	
    }
}
