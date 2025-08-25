import { StyleSheet, Dimensions} from 'react-native';
import metrics from '../../styles/metrics';

const {height} = Dimensions.get('window');

const styles = StyleSheet.create({
  contentView:{
    borderTopLeftRadius: 8,
    borderTopRightRadius: 8,
  },

  contentText: {
    padding: 15,
    marginTop: 4
  },

  img: {
    width: '100%',
    height: (height / 3),
    borderTopLeftRadius: 8,
    borderTopRightRadius: 8,
  },

  textTitle: {
    fontSize: 24,
    fontWeight: 'bold',
    textAlign: 'center',
    marginBottom:10,
  },

  description: {
    marginTop: 15,
    fontSize: metrics.fontImput,
  },

  bold:{
    fontWeight: 'bold' ,
    fontSize:17
  },

  itens:{
    marginTop:20
  },

  item:{
    marginTop:10
  }
});

export default styles;