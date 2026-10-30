const c=require('./purchase-orders-metadata-common.cjs');
c.session(async({api,runtime})=>{const {receipt}=await c.inspect(api,runtime);console.log(JSON.stringify(receipt));if(receipt.collisions||receipt.operationConflicts.length)process.exitCode=2;}).catch(error=>{console.error(error.message);process.exitCode=1;});
