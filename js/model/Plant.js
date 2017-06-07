/* @name: User
 * @author: Frias Marte Jeickson
 * @date: 02/06/2017
 * @description: describes the Plant data
 * @methods:
 *      construct
 *      set's and get's foor each attribute
 *
*/

function Plant()
{
    //Attributes declaration
    this.id;
    this.name;
    this.type;
    this.classe;
    this.family;
    this.order;
    this.kingdom;
    this.divition;
    this.subFamily;
    this.tribe;
    this.gender;
    
    
    
    
    

    //methods declaration
    this.construct = function (id, name,type,classe,family,order,kingdom,divition,subFamily,tribe,gender)
    {
        this.setId(id);
        this.setName(name);
        this.setType(type);
        this.setClasse(classe);
        this.setFamily(family);
        this.setOrder(order);
        this.setKingdom(kingdom);
        this.setDivition(divition);
        this.setSubFamily(subFamily);
        this.setTribe(tribe);
        this.setGender(gender);


        
    }
    
    //setters
    this.setId = function (id) {this.id=id;}
    this.setName = function (name) {this.name=name;}
    this.setType = function (type) {this.type=type;}
    this.setClasse = function (classe) {this.classe=classe;}
    this.setFamily = function (family) {this.family=family;}
    this.setOrder = function (order) {this.order=order;}
    this.setKingdom = function (kingdom) {this.kingdom=kingdom;}
    this.setDivition = function (divition) {this.divition=divition;}
    this.setSubFamily = function (subFamily) {this.subFamily=subFamily;}
    this.setTribe = function (tribe) {this.tribe=tribe;}
    this.setGender = function (gender) {this.gender=gender;}
    
   
    

    //getters
    this.getId = function () {return this.id;}
    this.getName = function () {return this.name;}
    this.getType = function () {return this.type;}
    this.getClasse = function () {return this.classe;}
    this.getFamily = function () {return this.family;}
    this.getOrder = function () {return this.order;}
    this.getKingdom = function () {return this.kingdom;}
    this.getDivition = function () {return this.divition;}
    this.getSubFamily = function () {return this.subFamily;}
    this.getTribe = function () {return this.tribe;}
    this.getGender = function () {return this.gender;}
   
    
    
    this.toString = function ()
    {
    	
    }
}
