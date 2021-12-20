
const PANCAKESWAP_ROUTER_V2 = "0x10ED43C718714eb63d5aA57B78B54704E256024E";
// -------------------
//  BNB mainnet Router V2 address

// const getWeb3 = () => {
//   // -------------------
//   // metamask import part.
//   return new Promise((resolve, reject) => {
//     window.addEventListener("load", async () => {
//       if (window.ethereum) {
//         const web3 = new Web3(window.ethereum);
//         try {
//           // ask user permission to access his accounts
//           await window.ethereum.request({ method: "eth_requestAccounts" });
//           resolve(web3);
//         } catch (error) {
//           reject(error);
//         }
//       } else {
//         reject("Please install MetaMask");
//       }
//     });
//   });
// };

// const getContract = async (web3) => {
//   const data = await $.getJSON("../contracts/IPancakeRouterV2.json");

//   // web3.eth.getBlockNumber()
//   // .then(()=> console.log('done'));
//   // -------------------
//   // you can check the block number anytime from here 


//   // console.log(web3.version);
//   // -------------------
//   // you can check the web3 version anytime from here


//   const greeting = await new web3.eth.Contract(data, PANCAKESWAP_ROUTER_V2);
// //  make it work Web3 
// // -------------------
//   return greeting;
// };
