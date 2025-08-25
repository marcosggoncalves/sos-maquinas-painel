import { StyleSheet, Dimensions } from 'react-native';
import colors from '../../styles/colors';
import metrics from '../../styles/metrics';

const {width, height} = Dimensions.get('window');

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: colors.fundoMain,
    alignItems: 'center'
  },

  containerSections: {
    flex: 1,
    width: '95%',
    height:'80%',
    justifyContent: 'space-between'
  },

  containerGrid3x3: {
    marginTop: 15,
    borderRadius: 8,
    height: (height - 310),
    backgroundColor: colors.branco,
    elevation: 4,
    paddingTop: 8,
    paddingBottom: 8,
    paddingLeft: 5,
    paddingRight: 5,
  },
  
  contentScroll:{  
    flexDirection: 'row',
    flexWrap: 'wrap',
  },

  containerSearch: {
    backgroundColor: colors.primaryColor,
    height: 70,
    width: '100%',
    alignItems: 'center',
    justifyContent: 'center'
  },

  boxPesquisa: {
    backgroundColor: colors.branco,
    height: 40,
    borderRadius: 80,
    width: '95%',
    flexDirection: 'row',
    alignItems: 'center',
  },

  iconPesquisa: {
    marginLeft: 15,
    marginRight: 25,
    paddingTop: 3
  },

  containerPublicidade: {
    height: 140,
    elevation: 4,
    borderRadius: 8,
    marginBottom: 10,
    marginTop: 10,
    backgroundColor: colors.branco,
    justifyContent: 'center',
    alignItems: 'center'
  },

  textPubli: {
    textTransform: 'uppercase',
    color: colors.pretoFosco,
    fontSize: metrics.fontButton,
    fontWeight: 'bold'
  }
});

export default styles;