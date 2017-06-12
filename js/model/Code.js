/* @name: User
 * @author: Frias Marte Jeickson
 * @date: 02/06/2017
 * @description: describes the Code data
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
    this.sequence;
    this.type;
    this.length;
    this.weight;
    

    //methods declaration
    this.construct = function (id, specie, name, type, length, weight,description,sequence)
    {
        this.setId(id);
        this.setSpecie(specie);
        this.setName(name);
        this.setType(type);
        this.setLength(length);
        this.setWeight(weight);
        this.setDesc(description);
        this.setSeq(sequence);
    }
    
    //setters
    this.setId = function (id) {this.id=id;}
    this.setSpecie = function (specie) {this.specie=specie;}
    this.setName = function (name) {this.name=name;}
    this.setType = function (type) {this.type=type;}
    this.setLength = function (length) {this.length=length;}
    this.setWeight = function (weight) {this.weight=weight;}
    this.setDesc = function (description) {this.description=description;}
    this.setSeq = function (sequence) {this.sequence=sequence;}

    //getters
    this.getId = function () {return this.id;}
    this.getSpecie = function () {return this.specie;}
    this.getName = function () {return this.name;}
    this.getType = function () {return this.type;}
    this.getLength = function () {return this.length;}
    this.getWeight = function () {return this.weight;}
    this.getDesc = function () {return this.description;}
    this.getSeq = function () {return this.sequence;}
  
    this.toString = function ()
    {
    	
    }
    
    this.cookieToObj = function (cookieObj)
	{
            //Specie
            var specie = new Specie();
            specie.construct(cookieObj.specie.id,cookieObj.specie.name,cookieObj.specie.description,"",cookieObj.specie.img);
            //Code
             this.setId(cookieObj.id); 
             this.setSpecie(specie);
             this.setName(cookieObj.name);
             this.setType(cookieObj.type);
             this.setLength(cookieObj.length);
             this.setWeight(cookieObj.weight);
             this.setDesc(cookieObj.description);
             this.setSeq(cookieObj.sequence);
	}
}
