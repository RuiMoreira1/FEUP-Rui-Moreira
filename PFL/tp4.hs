helper :: Int -> Integer
helper n = ( fibs !! n )

fibs :: [Integer]
fibs = 0 : 1 : (zipWith (+) fibs (tail fibs))

fibRec :: (Integral a) => a -> a
fibRec 0 = 0
fibRec 1 = 1
fibRec n = fibRec(n-1) + fibRec(n-2)
