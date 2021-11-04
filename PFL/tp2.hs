

prodPerf :: (Integral a) => [a] -> a
prodPerf xs = sum[ x | x <- xs]

squareSum = sum[ x | x <- [1 .. 100]]


dotProd :: [Float] -> [Float] -> Float
dotProd a b = sum[x*y | x <- a, y <- b]

primo :: Integer -> Bool
primo 
