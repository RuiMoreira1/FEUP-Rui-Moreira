{- Exercise 4.2 Pratical sheet 4 -}

calcPi1 :: Int -> Double 
calcPi1 n = sum $ take n $ zipWith (/) (cycle [4,-4]) [1,3 ..]

calcPi2:: Int -> Double 
calcPi2 n =  3 + (sum $ take n $ zipWith (/) (cycle [4,-4]) (zipWith (*) [2, 4..] $ zipWith (*) [3, 5..] [4, 6..])) 
