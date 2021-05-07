import moment from 'moment'
export default class Utils {
    formatName(lastname="", firstname=""){
        const formatedName = (
                                firstname 
                                ? firstname.substring(0,1).toUpperCase()+firstname.substring(1,(firstname.length)) 
                                : ""
                             )+" "+
                             (
                                (firstname && lastname) 
                                ? lastname.substring(0,1).toUpperCase()+"." 
                                :  
                                (
                                    (!firstname && lastname) 
                                    ? lastname.substring(0).toUpperCase()
                                    : ""                                     
                                )
                              )     
        return formatedName
    }

    formatDate(date=null){
        return date ? moment(date).format("DD-MM-YYYY H:m:s") : "Aucune date"
    }
}