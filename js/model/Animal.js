/* @name: User
 * @author: Frias Marte Jeickson
 * @date: 02/06/2017
 * @description: describes the Animal data
 * @methods:
 *      construct
 *      set's and get's foor each attribute
 *
*/

function Animal()
{
    //Attributes declaration
    this.id;
    this.name;
    this.type;
    this.classe;
    this.family;
    this.order;
    this.kingdom;
    this.superKingdom;
    this.subKingdom;
    this.superEdge;
    this.edge;
    this.subEdge;
    this.subClasse;
    this.subOrder;
    this.branch;
    
    
    
    

    //methods declaration
    this.construct = function (id, name,type,classe,family,order,kingdom,superKingdom,subKingdom,superEdge,edge,subEdge,subClasse,subOrder,branch)
    {
        this.setId(id);
        this.setName(name);
        this.setType(type);
        this.setClasse(classe);
        this.setFamily(family);
        this.setOrder(order);
        this.setKingdom(kingdom);
        this.setSuperKingdom(superKingdom);
        this.setSubKingdom(subKingdom);
        this.setSuperEdge(superEdge);
        this.setEdge(edge);
        this.setSubEdge(subEdge);
        this.setSubClasse(subClasse);
        this.setSubOrder(subOrder);
        this.setBranch(branch);

        
    }
    
    //setters
    this.setId = function (id) {this.id=id;}
    this.setName = function (name) {this.name=name;}
    this.setType = function (type) {this.type=type;}
    this.setClasse = function (classe) {this.classe=classe;}
    this.setFamily = function (family) {this.family=family;}
    this.setOrder = function (order) {this.order=order;}
    this.setKingdom = function (kingdom) {this.kingdom=kingdom;}
    this.setSuperKingdom = function (superKingdom) {this.superKingdom=superKingdom;}
    this.setSubKingdom = function (subKingdom) {this.subKingdom=subKingdom;}
    this.setSuperEdge = function (superEdge) {this.superEdge=superEdge;}
    this.setEdge = function (edge) {this.edge=edge;}
    this.setSubEdge = function (subEdge) {this.subEdge=subEdge;}
    this.setSubClasse = function (subClasse) {this.subClasse=subClasse;}
    this.setSubOrder = function (subOrder) {this.subOrder=subOrder;}
    this.setBranch = function (branch) {this.branch=branch;}
   
    

    //getters
    this.getId = function () {return this.id;}
    this.getName = function () {return this.name;}
    this.getType = function () {return this.type;}
    this.getClasse = function () {return this.classe;}
    this.getFamily = function () {return this.family;}
    this.getOrder = function () {return this.order;}
    this.getKingdom = function () {return this.kingdom;}
    this.getSuperKingdom = function () {return this.superKingdom;}
    this.getSubKingdom = function () {return this.subKingdom;}
    this.getSuperEdge = function () {return this.superEdge;}
    this.getEdge = function () {return this.edge;}
    this.getSubEdge = function () {return this.subEdge;}
    this.getSubClasse = function () {return this.subClasse;}
    this.getSubOrder = function () {return this.subOrder;}
    this.getBranch = function () {return this.branch;}

    
    
    this.toString = function ()
    {
    	
    }
}
